<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

public function index(){


    if(Auth::user()->hasRole('superadmin')){
        return view('superadmin.dashboard');
    }
    elseif(Auth::user()->hasRole('admin')){
        return view('superadmin.dashboard');
    }
}

public function Logout(Request $request){
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}

}
