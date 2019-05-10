<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competitions';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function matches(){
        return $this->hasMany('App\Match');
    }
    public function leagues(){
        return $this->hasMany('App\League');
    }
}
