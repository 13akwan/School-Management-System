<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [

            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'PKN',
            'PJOK',
            'Informatika',
            'Basis Data',
            'Pemrograman Web',
            'Jaringan Komputer',
            'Desain Grafis',
            'Akuntansi Dasar',
            'Administrasi Perkantoran',
            'PKK',
            'Sistem Komputer',
            'UI UX Design'

        ];

        foreach ($subjects as $subject) {

            Subject::create([
                'name' => $subject
            ]);

        }
    }
}