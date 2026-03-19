<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function create(){
        return view('image.create');
    }

    public function store(StoreImageRequest $request){

        $folder = "images/" . date('Y/m');

        foreach ($request->images as $imageFile){

            $filename = $this->makeUniqueFileName($imageFile);

            $imageFile->storeAs($folder, $filename);
        }
    }

    protected function makeUniqueFileName(UploadedFile $imageFile){

        $originalName = $imageFile->getClientOriginalName();

        $info = pathinfo($originalName);

        return Str::slug($info['filename'])
            . '_'
            . time()
            . '.'
            . $info['extension'] ;
    }
}
