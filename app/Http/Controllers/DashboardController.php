<?php

namespace App\Http\Controllers;
use App\Models\User as User;
use App\Models\Maping as Peta;
use App\Models\Maping;
use App\Models\WisataCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        
        return response()->view('dashboard.dashboard',[
            'peta' => Peta::count(),
            'kategori' => WisataCategory::all(),
            'admin' => User::where('role','admin')->count(),
            'user' => User::where('role','users')->count(),
            'data' => Auth::user()->role == 'admin' ? Maping::all() : Maping::where('user_id',Auth::user()->id)->get(),
        ]);
    }
}
