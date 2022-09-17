<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'memo',
        'category_id',
        'user_id',
        'game_id'
    ];
    
    protected static function boot()
    {
        //オーバーライドした親クラスの同名メソッドを呼び出す
        parent::boot();
        
        //保存時user_idをログインユーザーに設定
        self::saving(function($note) {
            $note->user_id = \Auth::id();
        });
    }
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
