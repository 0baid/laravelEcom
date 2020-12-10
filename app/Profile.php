<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    protected $gaurded = [];
    protected $dates = ['deleted_at'];

    protected $fillable = ['name','user_id','address','phone', 'thumbnail'];
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
