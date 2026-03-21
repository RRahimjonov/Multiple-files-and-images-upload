<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;


use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function create(){
        return view('image.create');
    }

    protected function  resizeImage(UploadedFile $imageFile)
    {
        $image = ImageManager::imagick()->read($imageFile->getRealPath());
        $image->scaleDown(320);
        return $image->toJpeg(quality: 80);
    }

    public function store(StoreImageRequest $request){

        $folder = "images/" . date('Y/m');

        foreach ($request->images as $imageFile){

            $filename = $this->makeUniqueFileName($imageFile);

            $resizedImage = $this->resizeImage($imageFile);

            $path = $folder.'/'.$filename;

            Storage::disk('public')->put($path, $resizedImage);

            Media::create([
                'filename' => $filename,
                'mime_type' => $imageFile->getMimeType(),
                'size' => strlen($resizedImage),
                'path' => $path
            ]);

            return to_route('images.index');
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
