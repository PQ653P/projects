<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Utils\StatusCode;

class ImageController extends GuardedController
{
    protected array $except = ['show'];

    public function index(){
        if (request('per_page', '0') !== '0')
            return Image::paginate(request('per_page'));

        return Image::all();
    }

    public function show(Image $image){
        return $image;
    }

    public function destroy(Image $image){
        $image->delete();
        return response()->json($image, StatusCode::ACCEPTED);
    }
}
