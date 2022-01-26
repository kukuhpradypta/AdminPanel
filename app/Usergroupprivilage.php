<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usergroupprivilage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_usergroup',
    ];
    public function usergroup()
    {
        return $this->belongsTo(Usergroup::class);
    }
}
