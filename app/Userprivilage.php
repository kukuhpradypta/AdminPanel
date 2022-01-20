<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userprivilage extends Model
{
    protected $fillable = [
        'id_user',
        'id_menu',
        'has_create',
        'has_update',
        'has_delete',
    ];
}