<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->truncate();

        $districts = [
            ['code' => '18', 'name' => 'Dhaka'],
            ['code' => '01', 'name' => 'Barguna'],
            ['code' => '02', 'name' => 'Barisal'],
            ['code' => '03', 'name' => 'Bhola'],
            ['code' => '04', 'name' => 'Jhalokati'],
            ['code' => '05', 'name' => 'Patuakhali'],
            ['code' => '06', 'name' => 'Pirojpur'],
            ['code' => '07', 'name' => 'Bandarban'],
            ['code' => '08', 'name' => 'Brahmanbaria'],
            ['code' => '09', 'name' => 'Chandpur'],
            ['code' => '10', 'name' => 'Chattogram'],
            ['code' => '11', 'name' => 'Cumilla'],
            ['code' => '12', 'name' => 'Cox\'s Bazar'],
            ['code' => '13', 'name' => 'Feni'],
            ['code' => '14', 'name' => 'Khagrachari'],
            ['code' => '15', 'name' => 'Lakshmipur'],
            ['code' => '16', 'name' => 'Noakhali'],
            ['code' => '17', 'name' => 'Rangamati'],
            ['code' => '19', 'name' => 'Faridpur'],
            ['code' => '20', 'name' => 'Gazipur'],
            ['code' => '21', 'name' => 'Gopalganj'],
            ['code' => '22', 'name' => 'Kishoreganj'],
            ['code' => '23', 'name' => 'Madaripur'],
            ['code' => '24', 'name' => 'Manikganj'],
            ['code' => '25', 'name' => 'Munshiganj'],
            ['code' => '26', 'name' => 'Narayanganj'],
            ['code' => '27', 'name' => 'Narsingdi'],
            ['code' => '28', 'name' => 'Rajbari'],
            ['code' => '29', 'name' => 'Shariatpur'],
            ['code' => '30', 'name' => 'Tangail'],
            ['code' => '31', 'name' => 'Bagerhat'],
            ['code' => '32', 'name' => 'Chuadanga'],
            ['code' => '33', 'name' => 'Jashore'],
            ['code' => '34', 'name' => 'Jhenaidah'],
            ['code' => '35', 'name' => 'Khulna'],
            ['code' => '36', 'name' => 'Kushtia'],
            ['code' => '37', 'name' => 'Magura'],
            ['code' => '38', 'name' => 'Meherpur'],
            ['code' => '39', 'name' => 'Narail'],
            ['code' => '40', 'name' => 'Satkhira'],
            ['code' => '41', 'name' => 'Jamalpur'],
            ['code' => '42', 'name' => 'Mymensingh'],
            ['code' => '43', 'name' => 'Netrokona'],
            ['code' => '44', 'name' => 'Sherpur'],
            ['code' => '45', 'name' => 'Bogura'],
            ['code' => '46', 'name' => 'Joypurhat'],
            ['code' => '47', 'name' => 'Naogaon'],
            ['code' => '48', 'name' => 'Natore'],
            ['code' => '49', 'name' => 'Chapainawabganj'],
            ['code' => '50', 'name' => 'Pabna'],
            ['code' => '51', 'name' => 'Rajshahi'],
            ['code' => '52', 'name' => 'Sirajganj'],
            ['code' => '53', 'name' => 'Dinajpur'],
            ['code' => '54', 'name' => 'Gaibandha'],
            ['code' => '55', 'name' => 'Kurigram'],
            ['code' => '56', 'name' => 'Lalmonirhat'],
            ['code' => '57', 'name' => 'Nilphamari'],
            ['code' => '58', 'name' => 'Panchagarh'],
            ['code' => '59', 'name' => 'Rangpur'],
            ['code' => '60', 'name' => 'Thakurgaon'],
            ['code' => '61', 'name' => 'Habiganj'],
            ['code' => '62', 'name' => 'Moulvibazar'],
            ['code' => '63', 'name' => 'Sunamganj'],
            ['code' => '64', 'name' => 'Sylhet'],
        ];

        DB::table('districts')->insert($districts);
    }
}
