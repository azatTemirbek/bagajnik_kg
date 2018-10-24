<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index(){
        $ratingList  = App\Rating::all();
        return $ratingList;
    }
    public function show($id){
;

        return App\Rating::find($id)-> with(['user'])->get();
    }
}
