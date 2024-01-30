<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //フォローのリレーション、🌟時間ある時読み解く
     // テーブル名
    protected $table = 'follows';

    // 一括代入を許可する属性
    protected $fillable = [
        'following_id',
        'followed_id',
        // 他にも必要な属性があればここに追加する
    ];


}
