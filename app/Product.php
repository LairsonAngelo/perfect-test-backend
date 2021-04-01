<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at','updated_at','deleted_at',
    ];

    protected $fillable = [
        'name','description','price'
    ];


    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', $value);
    }


    public function getPriceAttribute($value)
    {
        return $value ? number_format($value,2,",",".") : 0;
    }



  
}