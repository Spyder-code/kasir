<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $level = Auth::getUser()->level;
        $id = Auth::getUser()->id;
        if ($level == 1) {
            return redirect('/owner/user');
        } else if ($level == 2) {
            return redirect('/kasir/pembayaran');
        }
    }
}
