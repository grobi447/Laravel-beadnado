<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function contest(){
        return $this->belongsToMany(Contest::class, 'characters__contests', 'character_id', 'contest_id')->withPivot('hero_hp', 'enemy_hp');
    }
}
