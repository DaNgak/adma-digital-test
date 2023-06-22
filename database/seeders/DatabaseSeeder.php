<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Location;
use App\Models\Merek;
use App\Models\OrderTransport;
use App\Models\PricingOrder;
use App\Models\ServiceSchedule;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            [
                'phone' => '081234567891',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ],
            [
                'phone' => '081234567892',
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ],
            [
                'phone' => '08123456789',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
        ]);

        Merek::insert([
            [
                'name' => 'Toyota',
            ],
            [
                'name' => 'Honda',
            ],
            [
                'name' => 'Alphard',
            ]
        ]);

        Transport::insert([
            [
                'name' => 'Avanza 2017',
                'license_plate' => 'N 1234 GO',
                'size_passenger' => '5',
                'merek_id' => 1,
            ],
            [
                'name' => 'Brio 2020',
                'license_plate' => 'L 5678 GO',
                'size_passenger' => '4',
                'merek_id' => 2,
            ],
        ]);

        ServiceSchedule::insert([
            [
                'service_schedule_date' => '2023-02-02',
                'kilometer' => '10133',
                'price' => '300000',
                'description' => 'Servis Tap Oli dan Ban Belakang',
                'transport_id' => 1,
            ],
            [
                'service_schedule_date' => '2022-06-06',
                'kilometer' => '14240',
                'price' => '100000',
                'description' => 'Servis Tap Oli',
                'transport_id' => 1,
            ],
            [
                'service_schedule_date' => '2023-02-02',
                'kilometer' => '20491',
                'price' => '100000',
                'description' => 'Servis Tap Oli',
                'transport_id' => 2,
            ],
        ]);

        Location::insert([
            [
                'name' => 'Malang',
                'province' => 'Jawa Timur'
            ], 
            [
                'name' => 'Surabaya',
                'province' => 'Jawa Timur'
            ], 
            [
                'name' => 'Pandaan',
                'province' => 'Jawa Timur'
            ],
            [
                'name' => 'Bangkalan',
                'province' => 'Jawa Timur'
            ], 
        ]);

        PricingOrder::insert([
            [
                'location_start_id' => 1,
                'location_finish_id' => 2,
                'distance' => '89',
                'price' => '150000'
            ],
            [
                'location_start_id' => 1,
                'location_finish_id' => 3,
                'distance' => '42',
                'price' => '100000'
            ],
            [
                'location_start_id' => 1,
                'location_finish_id' => 4,
                'distance' => '125',
                'price' => '200000'
            ],
            [
                'location_start_id' => 2,
                'location_finish_id' => 3,
                'distance' => '50',
                'price' => '150000'
            ],
            [
                'location_start_id' => 2,
                'location_finish_id' => 4,
                'distance' => '36',
                'price' => '100000'
            ],
            [
                'location_start_id' => 3,
                'location_finish_id' => 4,
                'distance' => '84',
                'price' => '150000'
            ],
        ]);

        OrderTransport::insert([
            [
                'transport_id' => 1,
                'user_id' => 1,
                'total_passanger' => '1',
                'pickup_location' => 'Jalan Semanggi Barat no.18, Malang',
                'date_pickup' => '2023-06-06',
                'location_start_id' => 1,
                'location_finish_id' => 2,
                'pricing_order_id' => 1
            ],
        ]);
    }
}
