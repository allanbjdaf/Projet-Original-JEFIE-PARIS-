<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'poste',
        'category',
        'bio',
        'photo_url',
        'email',
        'linkedin_url',
        'ordre'
    ];
}
