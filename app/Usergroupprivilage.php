<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergroupprivilage extends Model
{
    protected $fillable = [
        'id_usergroup',
    ];
    public function usergroup()
    {
        return $this->belongsTo(Usergroup::class);
    }
}
