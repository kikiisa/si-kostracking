<?php

namespace App\Http\Controllers;

use App\Models\InformasiInstansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class SettingsController extends Controller
{
    private $path = 'assets/data/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('settings.index',[
            'data' => InformasiInstansi::find(1)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'deskripsi_apps' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = InformasiInstansi::find(1);
        $file = $request->has('image');
        if($file)
        {
            File::delete($this->path.$data->strukture_image);
            $files = $request->file('image');
            $newName = $files->hashName();
            $files->move($this->path,$newName);
            $data->update([
                'deskripsi_apps' => $request->deskripsi_apps,
                'strukture_image' => $newName
            ]);
            if($data)
            {
                return back()->with('success','Data Berhasil Di Ubah');
            }else{
                return back()->with('error','Data Gagal Di Ubah');
            }
        }else{
            $data->update(['deskripsi_apps' => $request->deskripsi_apps]);
            if($data)
            {
                return back()->with('success','Data Berhasil Di Ubah');
            }else{
                return back()->with('error','Data Gagal Di Ubah');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
