<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mastermenu extends Model
{
     protected $fillable = [
        'name',
        'icon',
        'url',
        'sort',
        'menugroup',
        'ishidden',
    ];
}
