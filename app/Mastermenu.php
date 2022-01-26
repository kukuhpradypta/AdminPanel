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
    public function userprivilage()
    {
        return $this->hasMany(Userprivilage::class);
    }
}
