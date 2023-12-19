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

    // ユーザーIDと投稿は一対一
    public function userId(){
        return $this->hasOne('App\User');
    }

    // Post.php
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
