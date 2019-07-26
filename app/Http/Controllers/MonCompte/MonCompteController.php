<?php

namespace App\Http\Controllers\MonCompte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class MonCompteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPage()
    {
        //return view('emails.verifCommande');
        $client = DB::table('STAUFF_webshop_client')
                    ->select('CardName as nom', 'Address as adresse', 'County', 'ZipCode', 'City as ville', 'name as pays')
                    ->where('CardCode', '=', Auth::user()->CardCode)
                    ->get();

        return view('onglet.account.monCompte')->with('client', $client);
    }
}
