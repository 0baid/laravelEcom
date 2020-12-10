<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;

class Product extends Model
{
    use SoftDeletes;
    protected $gaurded = [];
    protected $dates = ['deleted_at'];
    protected $fillable = ['title','description','price','discount','discount_price','thumbnail','options','featured'];
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_product');
    }
}
