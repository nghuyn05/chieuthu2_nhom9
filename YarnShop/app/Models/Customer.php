<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['id','name','email','password','phone','status'];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
