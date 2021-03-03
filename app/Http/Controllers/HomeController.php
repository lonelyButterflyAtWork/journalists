<?php

namespace App\Http\Controllers;
use App\Models\Journalists;
use App\Models\Journalists_voter;
use App\Models\Voters;
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
    public function vote(Request $request)
    {
        $ip = $request->getClientIp();

        $id = $request->get('id');

        $voicesByThisUser = Journalists::whereHas('voters', function($q) use($ip) {
                                        $q->where('voters.ip', $ip);
                                        })->count();

        $samerVoice = Voters::with('journalists')->where('ip', $ip)
                                                 ->whereHas('journalists', function($q) use($id) {
                                               $q->where('journalists.id', $id);
                                               })->count();

        if( $samerVoice == 0 && $voicesByThisUser < 5){

            $el = Voters::firstOrCreate(['ip'=> $ip]);

            $voters = Voters::find( $el['id'] );
            $voters->journalists()->attach($id);

            return redirect('/')->with('success', 'Dziękujemy za oddanie głosu!');
        } else{
            return redirect('/')->with('failed', 'Już zagłosowałeś na tego dziennikarza lub wykorzystałeś limit 5 głosów.');
        }
    }

}
