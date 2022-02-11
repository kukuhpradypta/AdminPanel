<?php

use Illuminate\Database\Seeder;
use App\Usergroup;

class UsergroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $USERGROUP = new Usergroup();
        $USERGROUP->name = 'admin';
        $USERGROUP->save();
    }
}
