<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usergroupprivilage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_usergroup',
        'id_menu',
        'has_view',
        'has_create',
        'has_update',
        'has_delete',
    ];
    public function usergroup()
    {
        return $this->belongsTo(Usergroup::class);
    }
}
