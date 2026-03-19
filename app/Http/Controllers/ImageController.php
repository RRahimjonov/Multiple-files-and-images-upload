<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(){
        return view('image.create');
    }

    public function store(StoreImageRequest $request){
        dd('data stores');
    }
}
