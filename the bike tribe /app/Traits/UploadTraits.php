<?php
// namespace App\Http\Controllers;
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ImageBank;
use App\Models\ImageInfo;

//use Intervention\Image\ImageManager;
use Image;

trait UploadTraits
{

	public function uploadMultipleImages($sliderfiles)
	{
		$outputfiles = array();
		foreach ($sliderfiles as $sliderfile) {
			if ($sliderfile) {
				//get filename with extension
				$filenamewithextension = $sliderfile->getClientOriginalName();

				//get filename without extension
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

				//get file extension
				$extension = $sliderfile->getClientOriginalExtension();

				//filename to store
				$filenametostore = $filename . '_' . time() . '.' . $extension;

				//Upload File
				$sliderfile->storeAs('public/uploads', $filenametostore);

				// $CKEditorFuncNum = $request->input('CKEditorFuncNum');
				$url = asset('storage/uploads/' . $filenametostore);
				$msg = 'Image successfully uploaded';
				//	$re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
				$relativeurl = 'storage/uploads/' . $filenametostore;

				// Render HTML output 
				// @header('Content-type: text/html; charset=utf-8'); 
				// return  $relativeurl;
				$outputfiles[] = $relativeurl;
			}
		}
		return $outputfiles;
	}

	public function uploadSingleImage($requestfiles)
	{
		$outputfile = '';

		if ($requestfiles) {
			//get filename with extension
			$filenamewithextension = $requestfiles->getClientOriginalName();

			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			//get file extension
			$extension = $requestfiles->getClientOriginalExtension();

			if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'bmp'  || $extension == 'gif' || $extension == 'doc' || $extension == 'webp' || $extension == 'docx') {
				//filename to store
				$filenametostore = $filename . '_' . time() . '.' . $extension;

				//Upload File
				$requestfiles->storeAs('public/uploads', $filenametostore);

				// $CKEditorFuncNum = $request->input('CKEditorFuncNum');
				$url = asset('storage/uploads/' . $filenametostore);
				$msg = 'Image successfully uploaded';
				//	$re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
				$relativeurl = 'storage/uploads/' . $filenametostore;

				// Render HTML output 
				// @header('Content-type: text/html; charset=utf-8'); 
				// return  $relativeurl;
				$outputfile = $relativeurl;
			} else {
				return  '';
			}
		}

		return $outputfile;
	}
	public function thumbnailSingleImage($requestfiles, $filenametostore, $width = 150, $height = 150)
	{
		$outputfile = '';

		if ($requestfiles) {

			$image = $requestfiles;
			//	$input['imagename'] = time().'.'.$image->extension();  
			//	$destinationPath = public_path('storage/uploads/thumbnail'); 
			$destinationPath = 'storage/uploads/thumbnail';
			$img = Image::make($image->path());
			$img->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath . '/' . $filenametostore);
			$outputfile = $destinationPath . '/' . $filenametostore;
		}

		return $outputfile;
	}

	public function uploadSingleFile($requestfiles)
	{
		$outputfile = '';

		if ($requestfiles) {
			//get filename with extension
			$filenamewithextension = $requestfiles->getClientOriginalName();

			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			//get file extension
			$extension = $requestfiles->getClientOriginalExtension();

			//filename to store
			$filenametostore = $filename . '_' . time() . '.' . $extension;

			//Upload File
			$requestfiles->storeAs('public/uploads', $filenametostore);

			// $CKEditorFuncNum = $request->input('CKEditorFuncNum');
			$url = asset('storage/uploads/' . $filenametostore);
			$msg = 'Image successfully uploaded';
			//	$re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
			$relativeurl = 'storage/uploads/' . $filenametostore;

			// Render HTML output 
			// @header('Content-type: text/html; charset=utf-8'); 
			// return  $relativeurl;
			//$outputfile=$filenametostore;
			$outputfile = $relativeurl;
		}

		return $outputfile;
	}

	/* Get slug for title */
    public function createSlugTrait($title, $id = 0,$dbtype)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id,$dbtype);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 50; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0,$dbtype)
    {
        return $dbtype::select('slug')->where('slug', 'like', $slug.'%')->where('id', '<>', $id)->get();
    }

 	public function create_thumbnail_image($imageid=NULL,$imagesrcpublic){

     try{

        if($imageid==NULL)
        {
            $id=microtime().rand(10000,99999);            
        }else
        {
            $id=$imageid;
        }
        $imageInfo = array();
        //echo $imagesrc;
       // exit;
        $imagesrc = storage_path(str_replace('storage/','app/public/',$imagesrcpublic));
        
       //   $imagesrc = $imagesrcpublic;
         $fullpath = $imagesrc;
        
        if(!empty($imagesrc) && file_exists($fullpath))
      //   if(!empty($imagesrc) && file_exists(public_path()."/".$imagesrc))
            {   

               // $image = (new ImageManager('gd'))->make($imagesrc)->scale(150, 150);
             	$image = Image::make($imagesrc);
                $image->resize(150, 150);
                // resize to 300 x 200 pixel
                if(!empty($id))
                {
                	$thumb_image_name = 'storage/uploads/thumbnail_'.$id.'.jpg';
                }else
                {
                	$thumb_image_name = 'storage/uploads/thumbnail'.'.jpg';
                }
               
               
               $response = $image->toJpeg()->save($thumb_image_name);

              // $mediumimage = (new ImageManager('gd'))->make($imagesrc)->scale(360, 240);
               	$mediumimage = Image::make($imagesrc);
            	$mediumimage->resize(360, 240);
                // resize to 360 x 240 pixel
               $medium_image_name = 'storage/uploads/medium_'.$id.'.jpg';
               $mediumimage->toJpeg()->save($medium_image_name);

            	//$bigimage = (new ImageManager('gd'))->make($imagesrc)->scale(2000, 2000);
            	$bigimage = Image::make($imagesrc);
            	$bigimage->resize(2000, 2000);

                // resize to 300 x 200 pixel
               $big_image_name = 'storage/uploads/big_'.$id.'.jpg';
               $bigimage->toJpeg()->save($big_image_name);
                 
                
               if($imageid!=NULL)
               {
                    ImageBank::where('id',$imageid)->update([
                    'big_url'=>$big_image_name,	
                    'medium_url'=>$medium_image_name,
                    'thumb_url'=>$thumb_image_name
                    ]);   

               }else
               {
                    $imageInfo = [
                    'big_url'=>$big_image_name,	
                    'medium_url'=>$medium_image_name,
                    'thumb_url'=>$thumb_image_name
                    ];
                   return $imageInfo;

               }
               

               

            }
           
        }catch (\Exception $e){

          //  echo $e->getMessage();

        } 
    }

    public function saveImage($title,$photo,$type,$property_id,$image_position='main_image')
    {
        $data = array();
        $data['title']      = $title;
        $data['caption']    = $title;
        $data['tags']       = $title;
        $files              = $photo;
        $image_url          = $this->uploadSingleImage($files);
       
        $data['image_url']  = $image_url; 
        if(!empty($image_url))
        {
            $imageInfo          = $this->create_thumbnail_image(NULL,$image_url); 
             
            if($imageInfo)
            {
                $data['big_url']    = $imageInfo['big_url'];  
                $data['medium_url'] = $imageInfo['medium_url']; 
                $data['thumb_url']  = $imageInfo['thumb_url']; 
            }
           
        }

        $ImageInfo = ImageBank::create($data);
        $image_bank_id = $ImageInfo->id;
		$imageInfo = array();
		$imageInfo['type'] = $type;
		$imageInfo['image_position'] = $image_position;
		$imageInfo['property_id'] = $property_id;
		$imageInfo['image_bank_id'] = $image_bank_id;
		ImageInfo::create($imageInfo);
        
    }
}
