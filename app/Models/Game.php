<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'    
    ];
    
    public function category()
    {
        return $this->belongsTo(Game::class);
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
