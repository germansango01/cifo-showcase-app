<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Carlos Mendoza',  'email' => 'carlos.mendoza@cifofse.edu'],
            ['name' => 'Laura Puig',      'email' => 'laura.puig@cifofse.edu'],
            ['name' => 'Marc Vidal',      'email' => 'marc.vidal@cifofse.edu'],
            ['name' => 'Ana Torres',      'email' => 'ana.torres@cifofse.edu'],
            ['name' => 'Jordi Serra',     'email' => 'jordi.serra@cifofse.edu'],
            ['name' => 'Lucia Navarro',   'email' => 'lucia.navarro@cifofse.edu'],
            ['name' => 'Pablo Ruiz',      'email' => 'pablo.ruiz@cifofse.edu'],
            ['name' => 'Marta Costa',     'email' => 'marta.costa@cifofse.edu'],
            ['name' => 'David León',      'email' => 'david.leon@cifofse.edu'],
            ['name' => 'Nuria Campos',    'email' => 'nuria.campos@cifofse.edu'],
            ['name' => 'Sergio Blanco',   'email' => 'sergio.blanco@cifofse.edu'],
            ['name' => 'Eva Soler',       'email' => 'eva.soler@cifofse.edu'],
            ['name' => 'Raul Peña',       'email' => 'raul.pena@cifofse.edu'],
            ['name' => 'Cristina Mora',   'email' => 'cristina.mora@cifofse.edu'],
            ['name' => 'Victor Roca',     'email' => 'victor.roca@cifofse.edu'],
        ];

        foreach ($teachers as $data) {
            Teacher::create($data);
        }
    }
}
