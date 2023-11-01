<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view("user.index",compact('data'));
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
    public function store(Request $request,$id)
    {
        $data = User::find($id);
        $data->update([
            'status' => $request->status
        ]);
        $text = Str::upper($request->status);
        if($data)
        {
            return redirect()->back()->with("success","Data Berhasil Di  {$text}");
        }else{
            return redirect()->back()->with("success","Data Gagal Di Aktifkan");
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

    public function pass_view()
    {
        return view("detail_user.setting");
    }

    public function update_pass(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'new' => 'required|min:8',
            'confirm' => 'required|same:new'
        ]);
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->old, $user->new)) {
            return redirect()->back()->with('error','Password saat ini tidak cocok');
        }
        // Jika password saat ini sesuai, perbarui password
        $user->update([
            'password' => bcrypt($request->new),
        ]);
    
        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        $data = User::find($id);
        $data->update($request->all());
        if($data)
        {
            return back()->with("success","Profile Berhasil Di Update");
        }else{
            return back()->with("error","Profile Gagal Di Update");
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
        $data = User::find($id)->delete();
        if($data)
        {
            return redirect()->back()->with("success","Data Berhasil Di Hapus");
        }else{
            return redirect()->back()->with("success","Data Gagal Di Hapus");
        }
    }

    public function profile()
    {
        return view('detail_user.profile');
    }
}
