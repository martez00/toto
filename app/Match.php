<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function competition(){
        return $this->belongsTo('App\Competition');
    }
    public function home_team() {
        return $this->belongsTo('App\Team', 'matches_home_team_foreign');
    }
    public function away_team() {
        return $this->belongsTo('App\Team', 'matches_away_team_foreign');
    }
}
