<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr1 = new User;
        $usr1->name = 'John';
        $usr1->nrp = '5113100106';
        $usr1->password = bcrypt('5113100106');
        $usr1->save();        

        $usr2 = new User;
        $usr2->name = 'Kez';
        $usr2->nrp = '5115100074';
        $usr2->password = bcrypt('5115100074');
        $usr2->save();        
    }
}
