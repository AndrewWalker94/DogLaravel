<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;


class Breed extends Model
{
    use HasFactory;
    protected $table = "breeds";

    public function parks(){
        return $this->morphedByMany(Park::class, 'breedable');
    }

    public function users(){
        return $this->morphedByMany(User::class, 'breedable');
    }
}


