<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    public $timestamps = false;
    protected $table = "parks";

    public function breeds(){
        return $this->morphToMany(Breed::class, 'breedable');
    }

    public function users(){
        return $this->morphToMany(User::class, 'userable');
    }
}
