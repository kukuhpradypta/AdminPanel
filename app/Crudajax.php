<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crudajax extends Model
{
    use softDeletes;
    protected $table = 'crudajaxs';
    protected $fillable = [
        'name',
    ];
    protected $hidden;
}
