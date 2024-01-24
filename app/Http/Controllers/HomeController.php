<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\InformasiInstansi;
use App\Models\Maping;
use App\Models\WisataCategory;
use Illuminate\Http\Request;
use App\Services\MyService;
class HomeController extends Controller
{
    public function index()
    {
        $wisata = Maping::with("categori")->latest()->take(6)->get();
        $kategori = WisataCategory::all(); 
        $service = new MyService();
        return view('frontend.home.index',[
            'wisata' => $wisata,
            'service' => $service,
            'kategori' => $kategori,
            'slider' => Fasilitas::all(),
        ]);
    }

    public function about()
    {
        $data = InformasiInstansi::all()->first();
        return view("frontend.about.index",compact('data'));
    }

    
    public function all()
    {
        $wisata = Maping::with("categori")->latest()->paginate(10);
        $kategori = WisataCategory::all(); 
        $service = new MyService();
        return view('frontend.home.all',[
            'wisata' => $wisata,
            'service' => $service,
            'kategori' => $kategori,
            
        ]);
    }
    public function show($id)
    {
        $wisata = Maping::with("categori","user")->paginate(10);
        $kategori = WisataCategory::all(); 

        $service = new MyService();
        return view('home.home',[
            'wisata' => $wisata,
            'service' => $service,
            'kategori' => $kategori,
        ]);   
    }
}



