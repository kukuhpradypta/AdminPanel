<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userprivilage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_user',
        'id_menu',
        'has_view',
        'has_create',
        'has_update',
        'has_delete',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
