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
        $USERGROUPPRIVILAGE->id_menu = '1';
        $USERGROUPPRIVILAGE->has_view = '1';
        $USERGROUPPRIVILAGE->has_create = '1';
        $USERGROUPPRIVILAGE->has_update = '1';
        $USERGROUPPRIVILAGE->has_delete = '1';
        $USERGROUPPRIVILAGE->save();
    }
}
