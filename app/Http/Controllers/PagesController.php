<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function boss(){
        return view('pages.boss');
    }
    public function about(){
        return view('pages.about');
    }
}
