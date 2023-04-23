<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Park;
use App\Models\Breed;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserController extends Controller
{
    public function CreateUser($name){
        $user = new User();
        $user->name = $name;
        $user->location = "TestArea";
        $user->email = "Test@Test.com";
        $user->password = "Test";
        $user->save();
    }

    //this links a user to a park or a breed
    //a user can have many breeds
    //many users can attend many parks
    public function LinkUser($user_id, Request $request){
        $user = User::where('id', $user_id)->first();
        if ($request->type == "Park"){
            $park = Park::where('id', $request->id)->first();
            $user->parks()->attach($park);
        }
        if ($request->type == "Breed"){
            $breed = Breed::where('id', $request->id)->first();
            $user->breeds()->attach($breed);
        }
        return response(200);
    }

    
}
