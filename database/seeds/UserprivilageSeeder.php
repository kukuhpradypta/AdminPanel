<?php

use Illuminate\Database\Seeder;
use App\Userprivilage;

class UserprivilageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PRIVILAGE = new Userprivilage();
        $PRIVILAGE->id_user = '1';
        $PRIVILAGE->id_menu = '1';
        $PRIVILAGE->has_create = '1';
        $PRIVILAGE->has_update = '1';
        $PRIVILAGE->has_delete = '1';
        $PRIVILAGE->save();
    }
}
