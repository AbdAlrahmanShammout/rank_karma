<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'url'
    ];

    public $timestamps = false;

    public function user(){
        return $this->hasMany(User::class, 'image_id');
    }
}
