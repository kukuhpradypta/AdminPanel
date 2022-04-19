<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mastermenu extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
        'icon',
        'url',
        'sort',
        'menugroup',
        'ishidden',
    ];
    public function usergroup()
    {
        return $this->hasMany(Usergroup::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
