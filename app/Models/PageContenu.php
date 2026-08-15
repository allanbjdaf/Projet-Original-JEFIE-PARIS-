<?php
// app/Models/PageContenu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageContenu extends Model
{
    use HasFactory;

    protected $table = 'page_contenus';

    protected $fillable = [
        'page',
        'cle',
        'valeur',
    ];
}
