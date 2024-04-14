<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $fillable = [
        'win',
        'history',
    ];
    public function character(){
        return $this->belongsToMany(Character::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function place(){
        return $this->belongsTo(Place::class, 'place_id');
    }
}
