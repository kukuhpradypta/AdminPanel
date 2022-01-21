<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{

    protected $fillable = [
        'name',
        'sort',
    ];
    public function usergroupprivilage()
    {
        return $this->hasMany(Usergroupprivilage::class);
    }
}
