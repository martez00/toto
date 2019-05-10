<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function matches(){
        $this->hasMany('App\Match');
    }
}
