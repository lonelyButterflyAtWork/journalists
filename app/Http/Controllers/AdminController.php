<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journalists;
use App\Models\Voters;

class AdminController extends Controller
{
    public function index(Type $var = null)
    {
        $journalists = Journalists::withCount("voters")->get();

        return view('dashboard', compact('journalists'));
    }

    public function showVotesAjax(Request $request){

        $id = $request['id'];

        $voters = Voters::with('journalists')->whereHas('journalists', function($q) use($id) {
            $q->where('journalists.id', $id);
        })->get();

        return response()->json(['data'=>$voters]);
    }
}
