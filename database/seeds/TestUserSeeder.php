<?php

use Illuminate\Database\Seeder;
use App\Hoa;
use App\ComplianceOfficer;
use App\User;
use App\Owner;
use App\BoardMember;
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
        $hoa = Hoa::where('name', 'Eldorado Heights Phase 1 HOA, Inc.')->first();

        /**
         * Compliance offer
         */
        $complianceOfficer = ComplianceOfficer::create([
            'hoa_id' => $hoa->id,
            'name' => 'Taylor Ticket',
            'phone_number' => '555-555-5555',
            'email_address' => 'compliance@example.com',
            'active' => true,
        ]);

        /**
         * Compliance officer user entity
         */
        User::create([
            'name' => 'Taylor Ticket',
            'email' => 'compliance@example.com',
            'password' => Hash::make('password'),
            'compliance_officer_id' => $complianceOfficer->id,
        ]);


        $boardMember = BoardMember::create([
            'hoa_id' => $hoa->id,
            'name' => 'Bob Morgan',
            'phone_number' => '(999) 888 7777',
            'email_address' => 'board@example.com',
            'active' => true,
        ]);

        /**
         * Board member user entity
         */
        User::create([
            'name' => 'Bob Morgan',
            'email' => 'board@example.com',
            'password' => Hash::make('password'),
            'board_member_id' => $boardMember->id,
        ]);

        $owner = Owner::where('name', 'Joselito & Nicole L. Delossantos')->first();

        /**
         * Owner user entity
         */
        User::create([
            'name' => 'Owen Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'owner_id' => $owner->id,
        ]);
    }
}
