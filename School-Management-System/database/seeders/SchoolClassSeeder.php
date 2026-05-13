<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            'RPL',
            'TKJ',
            'AKL',
            'DKV',
            'MPLB',
            'TKR'
        ];

        $grades = [
            'X',
            'XI',
            'XII'
        ];

        foreach ($grades as $grade) {

            foreach ($majors as $major) {

                for ($i = 1; $i <= 2; $i++) {

                    SchoolClass::create([

                        'name' => $grade . ' ' . $major . ' ' . $i

                    ]);

                }

            }

        }
    }
}