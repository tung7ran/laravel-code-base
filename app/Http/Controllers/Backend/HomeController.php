<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post\Pages;

class HomeController extends Controller
{
    public function index()
    {
//        $dataPages = Pages::orderBy('created_at')->get();
        return view('backend.home');
    }


    public function getLayOut(Request $request)
    {
        $index = $request->index;
        $type = $request->type;
        if(view()->exists('backend.repeater.row-'.$type)){
            return view('backend.repeater.row-'.$type, compact('index'))->render();
        }
        return '404';
    }
}
