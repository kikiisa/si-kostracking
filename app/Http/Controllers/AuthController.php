<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as Valid;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function index()
    {
        return view('frontend.auth.index',['title' => 'LOGIN - SISTEM-INFORMASI-GIS']);
    }


    public function store(Request $request)
    {
        
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            if (Auth::user()->status == 'aktif') {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                throw Valid::withMessages(['notif' => 'Maaf, akun Anda tidak aktif.']);
            }
        }
        throw Valid::withMessages(['notif' => 'Maaf Email Dan Password Anda Tidak Terdaftar']);
        
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|min:12',
            'confirm' => 'required|same:password'
        ]);

        $data = User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'users',
            'password' => bcrypt($request->password),
            'status' => 'nonaktif'
        ]);

        if($data)
        {
            return back()->with("success","Pendaftaran Berhasil, Status Akun Masih Dalam Peninjauan");
        }else{
            return back()->with("error","Gagal");
        }
    }

    public function create()
    {
        return view("frontend.auth.register");
    }
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
