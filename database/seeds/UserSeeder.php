<?php

use App\Hoa;
use App\BoardMember;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE board_members CASCADE');

        $hoa = Hoa::findOrFail(1);

        $boardmember = BoardMember::create([
            'hoa_id' => $hoa->id,
            'name' => 'Sherman Cabral',
            'phone_number' => '(999) 888 7777',
            'email_address' => 'email@domain.com',
            'active' => true,
        ]);

        $user = User::create([
            'name' => 'Sherman Cabral',
            'email' => 'email@domain.com',
            'password' => bcrypt('password'),
            'board_member_id' => $boardmember->id,
        ]);

        echo $user['name'] . PHP_EOL;

        $user = User::create([
            'name' => 'Kelly Bohl',
            'email' => 'bohl@domain.com',
            'password' => bcrypt('password'),
            'owner_id' => '4',
        ]);

        echo $user['name'] . PHP_EOL;
    }
}
