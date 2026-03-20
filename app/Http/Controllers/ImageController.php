<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;


use App\Models\Media;
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

            $path = $imageFile->storeAs($folder, $filename);

            Media::create([
                'filename' => $filename,
                'mime_type' => $imageFile->getMimeType(),
                'size' => $imageFile->getSize(),
                'path' => $path
            ]);
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

    public function index()
    {
        $media = Media::all();

        return view('image.index', compact('media'));
    }
}
