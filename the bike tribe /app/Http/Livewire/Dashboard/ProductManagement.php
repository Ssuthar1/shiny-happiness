<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductInventory;
use App\Models\Product;
use App\Models\CategoryProduct;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth ,Config;

class ProductManagement extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $startDate = '',$endDate = '',$s,$sku_id,$name,$updateId = '',$inventoryProductId,$slug,$image,$status=1,$is_latest=0,$is_bestselling=0,$is_top_rated=0,$is_new_arrival=0,$product_category,$oldImage,$parentCategory = [],$buttonText = "Update",$display_unit,$sale_unit,$display_mrp_price,$sale_mrp_price,$display_sale_price,$final_sale_price;
    protected $queryString = ['s'];
    public $unit_name , $current_stock ,$price ,$sale_price ,$out_of_stock,$inventoryId ,$custom_message,$inventoryData=[];
    public $pageType = 'index';
    public function mount(){
        $this->startDate = Carbon::now()->subDays(5)->startOfDay()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
        $this->parentCategory = Category::where('status',1)->latest()->get(); 
    }
    
    public function render()
    {
        $userInfo = Auth::user();
        $data = [];
        // if (!empty($this->startDate) && !empty($this->endDate)) {
            // $startTime = $this->startDate.' 00:00:00';
            // $endTime = $this->endDate.' 23:59:59';
            $data = Product::orderBy('id','DESC');
            if (!empty($this->s)) {
                $data = $data->where('name',trim($this->s));
            }
            $data = $data->with('getProductInventory')->paginate(10);
        // }
        return view('livewire.dashboard.products.index',compact('data'));
    }

    public function addProduct(){
        $this->pageType             = 'edit';
        $this->buttonText           = 'Save';
    }


    public function edit($id){
        $this->updateId = $id;
        $setting = Product::find($id);
        $this->product_category         = $setting->getProductCategory->category_id ?? '';
        $this->sku_id                   = $setting->sku_id;
        $this->name                     = $setting->name;
        $this->oldImage                 = $setting->image;
        $this->status                   = $setting->status;
        $this->display_unit             = $setting->display_unit;
        $this->sale_unit                = $setting->sale_unit;
        $this->display_mrp_price        = $setting->display_mrp_price;
        $this->sale_mrp_price           = $setting->sale_mrp_price;
        $this->display_sale_price       = $setting->display_sale_price;
        $this->final_sale_price         = $setting->final_sale_price;
        $this->is_latest                = $setting->is_latest;
        $this->is_bestselling           = $setting->is_bestselling;
        $this->is_top_rated             = $setting->is_top_rated;
        $this->is_new_arrival           = $setting->is_new_arrival;
        $this->pageType                 = 'edit';
    }

    public function cancel(){
        $this->reset('updateId','sku_id','name','image','oldImage','status','is_latest','is_bestselling','is_top_rated','is_new_arrival','pageType','buttonText','product_category');
        $this->resetValidation();
    }

    public function update(){

        $this->validate([
                'sku_id'                => 'required|unique:products,sku_id,' . $this->updateId . ',id,deleted_at,NULL',
                'product_category'      => 'required',
                'name'                  => 'required',
                'image'                 => (isset($this->oldImage) && !empty($this->oldImage)) ? 'nullable' :'required',
                'status'                => 'required',
                'display_unit'          => 'required',
                'sale_unit'             => 'required',
                'display_mrp_price'     => 'required',
                'sale_mrp_price'        => 'required',
                'display_sale_price'    => 'required',
                'final_sale_price'      => 'required',
            ],
            [
                'sku_id.required'   => 'SKU id field is required',
                'sku_id.unique'     => 'SKU id already exists',
                'name.required'     => 'Name field is required',
                'image.required'    => 'Image field is required',
                'status.required'   => 'Please select a status',
            ]
        );
        $image = '';
        if(isset($this->image) && !empty($this->image)){
            $image = $this->image->store('public');
        }else{
            $image = $this->oldImage;
        }
        if(isset($this->updateId) && !empty($this->updateId)){
            $data['sku_id']                 = $this->sku_id;
            $data['name']                   = $this->name;
            $data['image']                  = $image;
            $data['display_unit']           = $this->display_unit;
            $data['sale_unit']              = $this->sale_unit;
            $data['display_mrp_price']      = $this->display_mrp_price;
            $data['sale_mrp_price']         = $this->sale_mrp_price;
            $data['display_sale_price']     = $this->display_sale_price;
            $data['final_sale_price']       = $this->final_sale_price;
            $data['status']                 = $this->status;
            $data['is_latest']              = $this->is_latest;
            $data['is_bestselling']         = $this->is_bestselling;
            $data['is_top_rated']           = $this->is_top_rated;
            $data['is_new_arrival']         = $this->is_new_arrival;
            Product::updateOrCreate(['id'=>$this->updateId],$data);
            
            if(!empty($this->product_category)){
                CategoryProduct::updateOrCreate(['product_id'=>$this->updateId],['category_id'=>$this->product_category,'product_id'=>$this->updateId]);
            }
        }else{
            $data                           = new Product();
            $data['sku_id']                 = $this->sku_id;
            $data['name']                   = $this->name;
            $data['image']                  = $image;
            $data['display_unit']           = $this->display_unit;
            $data['sale_unit']              = $this->sale_unit;
            $data['display_mrp_price']      = $this->display_mrp_price;
            $data['sale_mrp_price']         = $this->sale_mrp_price;
            $data['display_sale_price']     = $this->display_sale_price;
            $data['final_sale_price']       = $this->final_sale_price;
            $data['status']                 = $this->status;
            $data['is_latest']              = $this->is_latest;
            $data['is_bestselling']         = $this->is_bestselling;
            $data['is_top_rated']           = $this->is_top_rated;
            $data['is_new_arrival']         = $this->is_new_arrival;
            $data->save();
            if(isset($data->id) && !empty($data->id) && !empty($this->product_category)){
                // foreach ($this->product_category as $key => $categoryData) {
                    CategoryProduct::create(['category_id'=>$this->product_category,'product_id'=>$data->id]);
                // }
            }
        }


        $this->cancel();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',  
            'message' => __("Product Save successfully."),
            'text' => __("Product Save successfully."),
        ]);
        
        return session()->flash('success', 'Product Save successfully.');
    }

    
    public function updateStatus($action,$id)
    {
        Product::where('id',$id)->update(['status'=>$action]);
         
        $this->dispatchBrowserEvent('swal:success', [
            'icon' => 'success',  
            'title' => __("Success"),
            'text' => __("Product status updated successfully."), 
        ]);
    }

    public function skuCode(){
        do{
            // $uid=rand('11111111','99999999');
            $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
            $randomAlphanumeric = Str::random(10, $characters);
            $booking_id = $randomAlphanumeric;
            $booking = Product::select('sku_id')->where('sku_id',$booking_id)->first();
        }
        while($booking !== null);  
        $this->sku_id = $booking_id;
        return $booking_id;
    }

    public function deleteProduct($id){
        if (!empty($id)) {
            $delete = Product::where('id',$id)->delete();
            return session()->flash('success', 'Product delete successfully.');
        }
    }

    public function deleteInventory($id){
        if (!empty($id)) {
            $delete = ProductInventory::where('id',$id)->delete();
            return session()->flash('success', 'Product Inventory delete successfully.');
        }
    }

    public function addInventory($id){
        $this->inventoryProductId   = $id;
        $this->inventoryData        = ProductInventory::where('product_id',$id)->orderBy('id','DESC')->get();
        $this->pageType             = 'addInventory';
        $this->buttonText           = 'Save';
    }

    public function inventoryEdit($id){
        $this->inventoryId          = $id;
        $data = ProductInventory::find($id);
        $this->unit_name             = $data->unit_name;
        $this->current_stock         = $data->current_stock;
        $this->price                 = $data->price;
        $this->sale_price            = $data->sale_price;
        $this->out_of_stock          = $data->out_of_stock; 
        $this->custom_message        = $data->custom_message; 
        $this->pageType              = 'addInventory';
        $this->buttonText            = 'Update';
    }

    public function inventoryIndex($id){
        $this->inventoryProductId   = $id;
        $this->inventoryData        = ProductInventory::where('product_id',$id)->orderBy('id','DESC')->get();
        $this->pageType             = 'inventoryIndex';
        $this->buttonText           = 'Save';
    }

    public function cancelInventory(){
        $this->reset('inventoryId','unit_name','current_stock','price','sale_price','out_of_stock','custom_message','inventoryData');
        $this->pageType             = 'inventoryIndex';
        $this->resetValidation();
    }

    public function saveInventory(){
        $this->validate([
                'unit_name'          => 'required',
                'current_stock'      => 'required',
                'price'              => 'required',
                // 'sale_price'         => 'required',
                'out_of_stock'       => 'required',
            ],
            [
                'unit_name.required'            => 'Unit Name field is required',
                'current_stock.required'    => 'Current Stock field is required',
                'price.required'            => 'Price field is required',
                // 'sale_price.required'       => 'Sale Price field is required',
                'out_of_stock.required'     => 'Out Of Stock field is required',
            ]
        );
        $data['product_id']             = $this->inventoryProductId;
        $data['unit_name']              = $this->unit_name;
        $data['current_stock']          = $this->current_stock;
        $data['price']                  = $this->price;
        $data['sale_price']             = $this->sale_price;
        $data['out_of_stock']           = $this->out_of_stock;
        $data['custom_message']         = $this->custom_message;
        ProductInventory::updateOrCreate(['id'=>$this->inventoryId],$data);
        
        $this->cancelInventory();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',  
            'message' => __("Product Inventory Save successfully."),
            'text' => __("Product Inventory Save successfully."),
        ]);
        
        return session()->flash('success', 'Product Inventory Save successfully.');
    }

}