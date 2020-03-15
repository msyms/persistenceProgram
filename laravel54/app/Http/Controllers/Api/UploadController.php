<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadClass;

class UploadController extends Controller
{
    
    public function uploadImg(Request $request)
	{
		$upload = new UploadClass(); 

		$upload->exts=array('jpg','png'); 

		$upload->maxSize=5*1024*1024; 
		$upload->savePath='storage/images'; 

		$file = $request->file('fileImg'); 

		$imgUrl = $upload->upload($file); 
		return response()->json(['data' => $imgUrl,'code' => 200], 200);
	}
}
