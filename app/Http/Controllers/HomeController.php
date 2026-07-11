<?php

namespace App\Http\Controllers;

use App\Models\settings;
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
        if (!Auth::check() || Auth::user()->is_admin) {
            // If user is not authenticated or not an admin, redirect them
            return redirect()->route('admin'); 
        }
        $heroImage = settings::all();
        $avatar = session()->get('avatar');
        return view('main', [
            'avatar' => $avatar,
            'heroImage' =>$heroImage
        ]);
    }
}
