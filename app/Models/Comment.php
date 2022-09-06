<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comment',
        'user_id',
        'post_id',
    ];
    
    protected static function boot()
    {
        //オーバーライドした親クラスの同名メソッドを呼び出す
        parent::boot();
        
        //保存時user_idをログインユーザーに設定
        self::saving(function($comment) {
            $comment->user_id = \Auth::id();
        });
    }
    
    //relation
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
