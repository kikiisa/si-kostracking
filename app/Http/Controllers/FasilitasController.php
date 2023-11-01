<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FasilitasController extends Controller
{
    private $path = 'assets/fasilitas/';
    public function index()
    {
        $data = Fasilitas::all()->where("users_id",Auth::user()->id);
        return view('images.images',compact('data'));
    }

    public function destroy($id)
    {
        $data = Fasilitas::find($id);
        File::delete($this->path.$data->image);
        $data->delete();
        if($data)
        {
            return redirect()->route('fasilitas')->with('success','Gambar Slider Berhasil Di Hapus');
        }else{
            return redirect()->route('fasilitas')->with('error','Gambar Slider Gagal Di Hapus');
        }
    }

    public function create()
    {
        return view('images.add');
    }

    public function store(Request $request)
    {
        if($request->hasFile("image"))
        {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);
            
            $image = $request->file("image");   
            $newName = $image->hashName();
            $image->move($this->path,$newName);
            $send = Fasilitas::create([
                'users_id' => Auth::user()->id,
                'uuid' => $request->uuid,
                'judul' => $request->judul,
                'image' => $newName
            ]);
            if($send)
            {
                return redirect()->route('fasilitas')->with('success','Gambar Fasilitas Berhasil Di Tambahkan');
            }else{
                return redirect()->route('fasilitas')->with('error','Gambar Fasilitas Gagal Di Tambahkan');
            }
        }else{
            
        }
    }
}
