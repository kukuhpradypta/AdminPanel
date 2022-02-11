<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usergroup extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
    ];
    public function usergroupprivilage()
    {
        return $this->hasMany(Usergroupprivilage::class);
    }
    public function mastermenu()
    {
        return $this->belongsTo(Mastermenu::class);
    }
}
