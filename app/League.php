<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $table = 'leagues';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function users(){
        return $this->hasMany('App\User');
    }
}
