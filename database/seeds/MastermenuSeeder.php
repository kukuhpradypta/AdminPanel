<?php

use Illuminate\Database\Seeder;
use App\Mastermenu;

class MastermenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MASTERMENU = new Mastermenu();
        $MASTERMENU->name = 'Mastermenu';
        $MASTERMENU->icon = 'fas fa-book';
        $MASTERMENU->url = 'mastermenu';
        $MASTERMENU->sort = '1';
        $MASTERMENU->menugroup = 'Mastermenu';
        $MASTERMENU->ishidden = '1';
        $MASTERMENU->save();
    }
}
