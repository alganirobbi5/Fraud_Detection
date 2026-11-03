<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = "data";

    protected $guarded = [];

    // protected $fillable = ['claim_date', 'city', 'insured_name'];

    public function scoring()
    {
        return $this->hasMany('App\Scoring');
    }

    
}
