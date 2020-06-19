<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'brand', 'category_id', 'description'
    ];

   // FK
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
