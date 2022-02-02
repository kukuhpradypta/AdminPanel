<?php

use Illuminate\Database\Seeder;
use App\Usergroupprivilage;

class UsergroupprivilageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $USERGROUPPRIVILAGE = new Usergroupprivilage();
        $USERGROUPPRIVILAGE->id_usergroup = '1';
        $USERGROUPPRIVILAGE->save();
    }
}
