<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    //
    public function index($image)
    {
        return response()->file(storage_path('app/public/images/' . $image));
    }
}
