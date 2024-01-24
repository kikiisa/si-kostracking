<?php

namespace App\Http\Controllers;
use App\Services\MyService;
use Illuminate\Http\Request;
use App\Models\Maping as Peta;
use App\Models\WisataCategory;
use Illuminate\Support\Facades\Auth;

class PemetaanController extends Controller
{
    private $path = 'assets/image/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles == 'admin'){
            $data = Peta::with("categori")->get();
            return view('maps.maps', compact('data'));
        }else{
            $data = Peta::with("categori")->where('user_id',Auth::user()->id)->get();
            return view('maps.maps', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
      */
    public function create()
    {
        $kategori = WisataCategory::all();
        return view('maps.add',compact("kategori"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rest_peta(Request $request)
    {
        $data = Peta::with('categori')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        $service = new MyService();
        $keyword = $request->keyword;
        $wisata = Peta::with('categori')->where('nama_titik','like','%'.$keyword.'%')->paginate(10);
        return view('frontend.home.search',[
            'wisata' => $wisata,
            'service' => $service,
            'judul' => $keyword
        ]);
    }

    public function rest_petaByLatAndLot($id1,$id2)
    {
        $lat = $id1;
        $lon = $id2;
        $data = Peta::with('categori')->where('latitude','=',$lat)->where('longitude','=',$lon)->first();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $service = new MyService();
        $request->validate([
            'uuid' => 'required',
            'name' => 'required',
            'long' => 'required',
            'kategori' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'diskon' => 'required',
            'lat' => 'required',
            'deskripsi' => 'required',
            'deskripsi_full' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        $files = [];
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move($this->path, $name);
                $files[] = $name;
            }
            $pemetaan = Peta::create([
                'uuid' => $request->uuid,
                'nama_titik' => $request->name,
                'latitude' => $request->lat,
                'user_id' => Auth::user()->id,  
                'bahari_id' => $request->kategori,
                'jam_buka' => $request->jam_buka,
                'jam_tutup' => $request->jam_tutup,
                'diskon' => $request->diskon,
                'longitude' => $request->long,
                'price' => $request->price,
                'deskripsi' => $request->deskripsi,
                'deskripsi_full' => $request->deskripsi_full,
                'image' => $service->returnNameMultiple($files),
            ]);
            if($pemetaan)
            {
                return redirect()->route('pemetaan')->with('success','Wilayah Berhasil Di Tambahkan');
            }else{
                return redirect()->route('pemetaan')->with('error','Wilayah Gagal Di Tambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = new MyService();
        $data = Peta::with("categori","user")->where("uuid",$id)->first();
        $image = $service->returnStringMerge($data->image);
        return view('frontend.home.detail',[
            'service' => $service,
            'data' => $data,
            'image' => collect($image),
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = new MyService();
        $data = Peta::all()->where('uuid','=',$id)->first();
        $categori = WisataCategory::all();
        $image = $service->returnStringMerge($data->image);
        return view('maps.edit',[
            'data' => $data,
            'image' => collect($image),
            'kategori' => $categori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = new MyService();
        $data = Peta::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'deskripsi' => 'required',
            'deskripsi_full' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'diskon' => 'required',
            'kategori' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        if($request->hasFile('image'))
        {
            $service->removeMultipleImage($data->image);
            $files = [];
            foreach ($request->file('image') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move($this->path, $name);
                $files[] = $name;
            }
            $pemetaan = $data->update([
                'nama_titik' => $request->name,
                'user_id' => Auth::user()->id,
                'latitude' => $request->lat,
                'longitude' => $request->long,
                'deskripsi' => $request->deskripsi,
                'deskripsi_full' => $request->deskripsi_full,
                'jam_buka' => $request->jam_buka,
                'diskon' => $request->diskon,
                'price' => $request->price,
                'jam_tutup' => $request->jam_tutup,
                'bahari_id' => $request->kategori,
                'image' => $service->returnNameMultiple($files),
            ]);
            if($pemetaan)
            {
                return redirect()->route('pemetaan')->with('success','Wilayah Berhasil Di Update');
            }else{
                return redirect()->route('pemetaan')->with('error','Wilayah Gagal Di Update');
            }
        }else{
            $data->update([
                    'nama_titik' => $request->name, 
                    'latitude' => $request->lat, 
                    'longitude' => $request->long, 
                    'user_id' => Auth::user()->id,
                    'deskripsi' => $request->deskripsi,
                    'jam_buka' => $request->jam_buka,
                    'jam_tutup' => $request->jam_tutup,
                    'bahari_id' => $request->kategori,
                    'diskon' => $request->diskon,
                    'deskripsi_full' => $request->deskripsi_full
            ]);
            if ($data) {
                return redirect()->route('pemetaan')->with('success', 'Data Titik Wilayah Berhasil Di Update');
            } else {
                return redirect()->route('pemetaan')->with('errors', 'Data Titik Wilayah Gagal Di Update');
            }
        }
    }

    public function upload_summernote(Request $request)
    {
        // return response()->json('fils')->status(200);
        if($request->hasFile('file'))
        {
            return response()->json('file ada');
        }else{
            return response()->json('file kosong');
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
        $service = new MyService();
        $data = Peta::find($id);
        $service->removeMultipleImage($data->image);
        $data->delete();
        if ($data) {
            return redirect()->route('pemetaan')->with('success', 'Data Berhasil Di Hapus');
        } else {
            return redirect()->route('pemetaan')->with('errors', 'Data Gagal Di Hapus');
        }
    }
}


