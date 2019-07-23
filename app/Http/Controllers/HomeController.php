<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Carbon\Carbon;

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
        $id = Auth::user()->id;
        $user = DB::table('stauff_users')->whereId($id)->first();

        if ($user->firstTime === '1') {
            return view('auth.passwords.change')->with('msg', "firstime");
        } else {
            $updated_at = Auth::user()->updated_at;
            $updated_at_plus_3_mois = $updated_at->addMonths(3);
            $updated_at_plus_3_mois->hour = 0;
            $updated_at_plus_3_mois->minute = 0;
            $dateNow = Carbon::now();

            if ($updated_at_plus_3_mois <= $dateNow) {
                return view('auth.passwords.change')->with('msg', "3months");
            } else {
                return view('onglet.home');
            }
        }

        //return view('home');
    }
}
