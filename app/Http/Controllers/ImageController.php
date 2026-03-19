<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(){
        return view('image.create');
    }

    public function store(){
        dd('data stores');
    }
}
