<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','category_id','name','price','stock','status','image','description'];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
