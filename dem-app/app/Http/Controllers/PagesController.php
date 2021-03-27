<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function adm(){
        return view('Dem.adm');
    }

    function Dem(){
        return view('Dem.Demenagement');
    }

    function market(){
        return view('Dem.Market');
    }
}
