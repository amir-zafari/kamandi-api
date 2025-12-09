<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CaseMedicalType;

class CaseMedicalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => 1, 'name' => 'متن'],
            ['id' => 2, 'name' => 'دست نویس'], 
            ['id' => 3, 'name' => 'اسناد'],
            ['id' => 4, 'name' => 'گزارش ویزیت'],
        ];

        foreach ($types as $type) {
            \App\Models\CaseMedicalType::updateOrCreate(
                ['id' => $type['id']], 
                ['name' => $type['name']]
            );
        }
    }
}
