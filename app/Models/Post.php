<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
    ];
    
    protected static function boot()
    {
        //オーバーライドした親クラスの同名メソッドを呼び出す
        parent::boot();
        
        //保存時user_idをログインユーザーに設定
        self::saving(function($post) {
            $post->user_id = \Auth::id();
        });
    }
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    //relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
