<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage($filename)
    {
        $path =  'images/' . $filename;

        if (!Storage::exists($path)) {
            echo $path;
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        $response = response($file, 200)->header('Content-Type', $type);

        return $response;
    }
}
