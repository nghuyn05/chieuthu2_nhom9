<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['id','customer_id','name','phone','address_line','district','city','is_default'];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
