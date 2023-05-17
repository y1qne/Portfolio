<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // why?

class IndexController extends Controller
{
    public function showIndex(){
        // appelle votre vue
        return view('index');
    }

    public function showRegister(){
        // appelle votre vue
        return view('register');
    }
}