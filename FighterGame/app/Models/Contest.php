<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $fillable = [
        
    ];
    public function character(){
        return $this->belongsToMany(Character::class, 'characters__contests', 'contest_id', 'character_id')->withPivot('hero_hp', 'enemy_hp');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function place(){
        return $this->belongsTo(Place::class, 'place_id');
    }
}
