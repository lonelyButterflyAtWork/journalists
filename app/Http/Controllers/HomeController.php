<?php

namespace App\Http\Controllers;
use App\Models\Journalists;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $journalists = Journalists::withCount("voters")->get();

        return view('welcome', compact('journalists'));
    }
}
