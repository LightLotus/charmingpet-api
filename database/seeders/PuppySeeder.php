<?php

namespace Database\Seeders;

use App\Models\Puppy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuppySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puppies = [
            [
                'date' => 'September 22, 2022',
                'timestart' => '10:30 am',
                'timeend' => '11:30 am',
                'trainer' => 'Keith Thurman',
                'availslot' => 10,
                'status' => 'available'
            ],
            [
                'date' => 'September 23, 2022',
                'timestart' => '10:30 am',
                'timeend' => '11:30 am',
                'trainer' => 'Sunny Lane',
                'availslot' => 10,
                'status' => 'available'
            ],
            [
                'date' => 'September 24, 2022',
                'timestart' => '9:30 am',
                'timeend' => '10:30 am',
                'trainer' => 'Nach Vidal',
                'availslot' => 10,
                'status' => 'available'
            ],
            [
                'date' => 'September 26, 2022',
                'timestart' => '9:30 am',
                'timeend' => '10:30 am',
                'trainer' => 'Chloe Adams',
                'availslot' => 10,
                'status' => 'available'
            ],
        ];
        foreach ($puppies as $key => $value) {
            Puppy::create($value);
        }
    }
}
