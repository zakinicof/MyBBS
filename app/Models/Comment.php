<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // テーブル名
    protected $table = 'comments';

    // 可変項目
    protected $fillable = 
    [
        'name',
        'comment',
        'post_id'
    ];
}
