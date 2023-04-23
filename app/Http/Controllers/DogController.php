<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use App\Models\Breed;
use App\Models\User;
use App\Models\Park;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Relations\Relation;
use \stdClass;

class DogController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function AllBreeds()
    {
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breeds/list/all');
        return json_decode($res->getBody())->message;
    }

    //I wasn't sure what info to return so I just returned the sub-breeds
    public function GetBreed($breedid)
    {
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breeds/list/all');
        $dogs = json_decode($res->getBody(), true)['message'];
        if (array_key_exists($breedid, $dogs)){
            return $dogs[$breedid];
        }else{
            return "No breed found";
        }
    }

    public function GetRandomBreed(){
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breeds/list/all');
        $dogs = json_decode($res->getBody(), true)['message'];
        return array_rand($dogs, 1);
    }


    public function GetBreedImage($breedid)
    {
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breed/'.$breedid.'/images/random');
        return json_decode($res->getBody())->message;
    }

    //this function is to populate the breeds table using data from dog.ceo, if data already exists drop the data and save it again
    public function SaveAllBreeds(){
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breeds/list/all');
        $breeds = array_keys((array)(json_decode($res->getBody())->message));

        Breed::truncate();

        for ($i=0; $i < count($breeds); $i++) { 
            $newdata = new Breed();
            $newdata->name = $breeds[$i];
            $newdata->save();
        }

        return "Saved all breeds to the database";
    }

    //I have not used Redis before so I hope this is correct
    public function CacheDogs(){
        $redis = Redis::connection();
        $client = new Client(['verify' => false]);
        $res = $client->request('get', 'https://dog.ceo/api/breeds/list/all');
        $dogs = json_decode($res->getBody())->message;
        $redis->set('breeds', json_encode($dogs));
        return "cached dog breeds";
    }

    public function GetCache(){
        $redis = Redis::connection();
        $response = $redis->get('breeds');
        return $response;
    }

    //returns the breed data including users and parks that are connected
    public function GetBreedData($breed_id){
        $breed = Breed::where('id', $breed_id)->first();
        $data = new stdClass();
        $data->breed = $breed;
        $data->parks = $breed->parks;
        $data->users = $breed->users;
        return $data;
    }
}
