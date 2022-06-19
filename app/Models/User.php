<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'karma_score',
        'image_id',
    ];

    public $with = ['image'];

    public $timestamps = false;

    public function image(){
        return $this->belongsTo(Image::class, 'image_id');
    }


}
