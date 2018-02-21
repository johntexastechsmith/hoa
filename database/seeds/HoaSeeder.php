<?php

use App\Hoa;
use App\Owner;
use App\OwnerAddress;
use App\Property;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;

class HoaSeeder extends Seeder
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
        DB::statement('TRUNCATE properties CASCADE');
        DB::statement('TRUNCATE hoa CASCADE');

        $faker = $faker = Faker\Factory::create();

        $path = storage_path('loaders/OwnerPropertiesLoadFile.csv');

        //load the CSV document from a file path
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        foreach ($records as $record) {

            $hoa = Hoa::where('name', $record['hoa'])->first();

            // if Hoa doesn't exist create new one
            if (($hoa instanceof Hoa) === false) {
                $hoa = Hoa::create([
                    'name' => $record['hoa'],
                    'street_address_line_1' => $faker->streetAddress,
                    'city' => 'Mckinney',
                    'state' => 'TX',
                    'zip' => '75070',
                    'uri' => 'hoa.test'
                ]);
            }

            $owner = Owner::create([
                'account_name' => $record['account_name'],
                'name' => $record['name'],
                'phone_number' => $record['phone_number'],
                'email_address' => $record['email_address'],
                'active' => true,
                'hoa_id' => $hoa->id
            ]);

            OwnerAddress::create([
                'owner_id' => $owner->id,
                'street_number' => $record['owner_address_street_number'],
                'street_name' => $record['owner_address_street_name'],
                'city' => $record['owner_address_city'],
                'state' => $record['owner_address_state'],
                'zip' => $record['owner_address_zip'],
                'in_use' => true
            ]);

            $geocoding = \GoogleMaps::load('geocoding')
                ->setParam ([
                    'address'    => $record['street_number'] . ' ' . $record['street_name'] . ', ' . $record['city'] . ', ' . $record['state'] . ' ' . $record['zip'],
                    'components' => [
                        'country'              => 'US',
                    ]

                ])
                ->get();
            $geocoding = json_decode($geocoding);

            $property = Property::create([
                'street_number' => $record['street_number'],
                'street_name' => $record['street_name'],
                'city' => $record['city'],
                'state' => $record['state'],
                'zip' => $record['zip'],
                'lat' => $geocoding->results[0]->geometry->location->lat,
                'lng' => $geocoding->results[0]->geometry->location->lng,
                'hoa_id' => $hoa->id
            ]);

            $property->owners()->attach($owner);
            $property->save();

            echo $record['street_number'] . PHP_EOL;
        }
    }
}
