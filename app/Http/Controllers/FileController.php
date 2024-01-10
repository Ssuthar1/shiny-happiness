<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use File;
use Response;

class FileController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function about(){
        return view('dashboard.layouts.index');
    }
    public function displayImage(Request $request)
    {
        $url = $request->imagepath;

        $url = str_replace('storage/','public/',$url);
       
        $path = storage_path('app/'.$url); 
        if (!File::exists($path)) {
            abort(404);
        } 
        $file = File::get($path);
        $type = File::mimeType($path); 
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

}
