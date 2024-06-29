<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()  {
        // dd('hallo');
        return view('pages.frontend.index');
    }
    public function ai()  {
        return view('pages.frontend.ai');
    }
    public function fitur()  {
        return view('pages.frontend.fitur');
    }
    public function penerapan()  {
        return view('pages.frontend.penerapan');
    }
    public function profile()  {
        return view('pages.frontend.profile');
    }
    public function kontak()  {
        return view('pages.frontend.kontak');
    }
}
