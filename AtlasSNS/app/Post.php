<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //　モデルのところ復習
    protected $fillable = [
        'post',
        'user_id',
    ];

    // Post.php
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
