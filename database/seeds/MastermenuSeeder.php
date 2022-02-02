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
        // $MASTERMENU = new Mastermenu();
        // $MASTERMENU->name = 'Mastermenu';
        // $MASTERMENU->icon = 'fas fa-book';
        // $MASTERMENU->url = 'mastermenu';
        // $MASTERMENU->sort = '1';
        // $MASTERMENU->menugroup = 'Mastermenu';
        // $MASTERMENU->ishidden = '1';
        // $MASTERMENU->save();
        $MASTERMENU = [
            [
                'name' => 'Master menu',
                'icon' => 'fas fa-book',
                'url' => 'mastermenu',
                'sort' => '1',
                'menugroup' => 'Mastermenu',
                'ishidden' => '1',
            ],
            [
                'name' => 'User group',
                'icon' => 'fas fa-users',
                'url' => 'usergroup',
                'sort' => '2',
                'menugroup' => 'Usergroup',
                'ishidden' => '1',
            ],
            [
                'name' => 'User privilage',
                'icon' => 'fas fa-user-lock',
                'url' => 'userprivilage',
                'sort' => '3',
                'menugroup' => 'Userprivilage',
                'ishidden' => '1',
            ],
            [
                'name' => 'User',
                'icon' => 'fas fa-user',
                'url' => 'user',
                'sort' => '4',
                'menugroup' => 'User',
                'ishidden' => '1',
            ],
            [
                'name' => 'User group privilage',
                'icon' => 'fas fa-user-shield',
                'url' => 'usergroupprivilage',
                'sort' => '5',
                'menugroup' => 'Usergroupprivilage',
                'ishidden' => '1',
            ],
        ];

        \DB::table('mastermenus')->insert($MASTERMENU);

    }
}
