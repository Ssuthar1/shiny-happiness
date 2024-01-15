<?php
// namespace App\Http\Controllers;
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Image;

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
}
