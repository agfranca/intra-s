<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Noticia;
use App\Banner;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $usuario = auth()->user()->name;
        $noticiasdousuario = Noticia::noticias();
         $img = Image::make('marca/intras.png');
         $avatar = Image::make('marca/avatar.png');
         $banner1 = Image::make('banner/1.jpg');
         $banner2 = Image::make('banner/2.jpg');
         $banner3 = Image::make('banner/3.jpg');
         $banner4 = Image::make('banner/4.jpg');

         $urls_banners = Banner::bannersite(); 
                  
        return view('site/index', compact('usuario','noticiasdousuario','img','avatar','banner1','banner2','banner3','banner4','urls_banners'));
    }
}
