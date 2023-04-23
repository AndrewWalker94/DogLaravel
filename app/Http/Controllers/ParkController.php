<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Park;
use App\Models\Breed;

class ParkController extends Controller
{
    public function CreatePark($name){
        $park = new Park();
        $park->name = $name;
        $park->save();
    }

    
    //this links a breed to a park
    public function LinkBreed($park_id, Request $request){
        $park = Park::where('id', $park_id)->first();

        if ($request->type == "Breed"){
            $breed = Breed::where('id', $request->id)->first();
            $park->breeds()->attach($breed);
        }
        
        return response(200);
    }
}
