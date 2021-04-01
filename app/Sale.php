<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Sale extends Model
{
    use SoftDeletes;

    protected $dates = [
        'data','created_at','updated_at','deleted_at',
    ];

    protected $appends = [
        'total','editUrl'
    ];

    protected $fillable = [
        'amount','discount','status','product_id','client_id','date'
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDateAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('d/m/Y');
    }


    public function getTotalAttribute()
    {
        return isset($this->product) ? number_format(($this->product->getRawOriginal('price')*$this->amount) - $this->discount,2,",",".") : 0;
    }

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = str_replace(',', '.', $value);
    }


    public function getEditUrlAttribute(){
        return route('sales.edit',[$this->id]);
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
  
}