<?php

namespace App\Http\Controllers;

use App\Models\WisataCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriWisata extends Controller
{
    public function index()
    {
        $data = WisataCategory::all();
        return view("kategori.kategori",compact("data"));
    }

    public function create()
    {
        return view("kategori.add");
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
        ]);
        $data = WisataCategory::create([
            'uuid' => $request->uuid,
            'nama' => $request->kategori,
            'slug' => Str::slug($request->kategori),
            'deskripsi' => $request->deskripsi,
        ]);
        if($data) {
            return redirect()->route('kategori')->with('success', 'Kategori Berhasil Di Tambahkan');
        } else {
            return redirect()->route('kategori')->with('error','Kategori Gagal Di Tambahkan');
        }
    }

    public function edit($id)
    {
       $data = WisataCategory::all()->where("uuid",$id)->first();
       return view("kategori.edit",compact("data"));
    }

    public function update(Request $request,$id)
    {
        $data = WisataCategory::find($id);
        $data->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi
        ]);
        if($data) {
            return redirect()->route('kategori')->with('success', 'Kategori Berhasil Di Update');
        } else {
            return redirect()->route('kategori')->with('error','Kategori Gagal Di Update');
        }        
    }
    public function delete(Request $request,$id)
    {
        $data = WisataCategory::find($id);
        $data->delete();
        if($data) {
            return redirect()->route('kategori')->with('success', 'Kategori Berhasil Di Update');
        } else {
            return redirect()->route('kategori')->with('error','Kategori Gagal Di Update');
        }        
    }
}
