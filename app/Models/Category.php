<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id'
    ];


    function children()
    {
    	return $this->hasMany('App\Models\Category','parent_id');
    }
    
    function parent()
    {
    	return $this->belongsTo('App\Models\Category','parent_id','id');
    }
    
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}


