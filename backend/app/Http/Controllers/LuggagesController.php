<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LuggagesController extends Controller
{
    public function index(){
        $luggageList  = App\Luggage::all();
        return $luggageList;
    }
    public function show($id){

        return App\Luggage::find($id)-> with(['user'])->get();
    }
}
