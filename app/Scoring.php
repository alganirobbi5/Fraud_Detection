<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoring extends Model
{

    protected $table = "scoring";

    protected $guarded = [];
    public function data()
    {
        return $this->belongsTo('App\Data');
    }
}
