<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";
    protected $fillable = ['id','customer_id','product_id','score','comment'];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
