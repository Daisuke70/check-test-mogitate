<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function seasons()
    {
        return $this->belongsTo(Season::class,'product_season','product_id','season_id',);
    }
}

