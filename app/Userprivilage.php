<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userprivilage extends Model
{
    protected $fillable = [
        'id_user',
        'id_menu',
        'namemenu',
        'has_create',
        'has_update',
        'has_delete',
    ];
    public function mastermenu()
    {
        return $this->belongsTo(Mastermenu::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}