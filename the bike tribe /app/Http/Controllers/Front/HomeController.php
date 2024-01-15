<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Razorpay\Api\Api;
use App\Models\Banner; 
use App\Models\Subscriber; 
use App\Models\Tour; 
use App\Models\Destination; 
use App\Models\Testimonial; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Auth;
class HomeController extends Controller
{
    
    public function index(Request $request){

        $banners = Banner::orderBy('id','DESC')->where('status',1)->get();
        $testimonials = Testimonial::orderBy('id','DESC')->where('status',1)->get();
        $destinations = Destination::orderBy('title','ASC')->where('status',1)->get();
        return view('frontend.home',compact('banners','testimonials','destinations'));
    } 
    public function aboutUs(Request $request){

        return view('frontend.about-us');
    } 
    public function contactUs(Request $request){

        return view('frontend.contact-us');
    }
    public function blog(Request $request){

        return view('frontend.blog');
    }
    public function postDetail(Request $request){

        return view('frontend.blog-single');
    }
    public function destinations(Request $request){

        return view('frontend.destinations');
    }
    public function destinationDetail(Request $request){

        return view('frontend.destination-detail');
    }
    public function tours(Request $request){

        return view('frontend.tours');
    }
    public function toursDetail(Request $request,$tour){

        $data = Tour::where('slug',$tour)->where('status',1)->first();
        if($data)
        {
            if($data->tour_category_id==5)
            {
                return view('frontend.one-day-tour',compact('data'));
            }else{
                
                return view('frontend.multi-day-tour',compact('data'));
            } 

        }else{
            return redirect('not-found');
        } 
        
    }

    public function bookTour(Request $request){

        return view('frontend.book-tour');
    }
    
    public function returnPolicy(Request $request){

        return view('frontend.return-policy');
    }
    public function termsCondition(Request $request){

        return view('frontend.terms-condition');
    }
    public function privacyPolicy(Request $request){

        return view('frontend.privacy-policy');
    }
    public function faq(Request $request){

        return view('frontend.faq');
    }
     
    
    
     
   

}