<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id','customer_id','total_price','status'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
