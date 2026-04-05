<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['id','customer_id'];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
