<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE owners CASCADE');
        DB::statement('TRUNCATE owner_addresses CASCADE');
        DB::statement('TRUNCATE board_members CASCADE');
        DB::statement('TRUNCATE compliance_officers CASCADE');
        DB::statement('TRUNCATE users CASCADE');
        DB::statement('TRUNCATE properties CASCADE');
        DB::statement('TRUNCATE hoa CASCADE');

        $this->call(HoaSeeder::class);
        $this->call(TestUserSeeder::class);
    }
}
