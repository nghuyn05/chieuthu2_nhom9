<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id','name','description','status','image'];
    public function products(){
        return $this->hasMany(Product::class,'product_id','id');
    }
}
