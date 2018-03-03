<?php

use Illuminate\Database\Seeder;
use App\Hoa;
use App\ComplianceOfficer;
use App\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE users CASCADE');
        DB::statement('TRUNCATE owners CASCADE');
        DB::statement('TRUNCATE compliance_officers CASCADE');

        $hoa = Hoa::find(1);

        $complianceOfficer = ComplianceOfficer::create([
            'hoa_id' => $hoa->id,
            'name' => 'Taylor Ticket',
            'phone_number' => '555-555-5555',
            'email_address' => 'compliance@example.com',
            'active' => true,
        ]);

        $user = User::create([
            'name' => 'Taylor Ticket',
            'email' => 'compliance@example.com',
            'password' => Hash::make('qwe321'),
            'compliance_officer_id' => $complianceOfficer->id,
        ]);
    }
}
