<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // category_id: 1=Prog&Dev, 2=Ciberseg, 3=TecEmerg, 4=CompDig
        // teacher_id follows SQL course_teacher: course N → teacher N (1-15), then cycles 1-5
        $courses = [
            [1, '20/CIFOFSE-PD/101/2457812/001', 'Curso de Laravel Básico',          'Curs de Laravel Bàsic',              1],
            [1, '20/CIFOFSE-PD/102/2457813/002', 'Fundamentos de Java',               'Fonaments de Java',                  2],
            [1, '21/CIFOFSE-PD/103/2457814/003', 'Desarrollo Frontend con React',     'Desenvolupament Frontend amb React', 3],
            [1, '21/CIFOFSE-PD/104/2457815/004', 'Introducción a SQL',                'Introducció a SQL',                  4],
            [1, '22/CIFOFSE-PD/105/2457816/005', 'Node.js para Principiantes',        'Node.js per a Principiants',         5],
            [1, '22/CIFOFSE-PD/106/2457817/006', 'Python y Automatización',           'Python i Automatització',            6],
            [1, '23/CIFOFSE-PD/107/2457818/007', 'APIs REST con Spring Boot',         'APIs REST amb Spring Boot',          7],
            [1, '23/CIFOFSE-PD/108/2457819/008', 'Bases de Datos Relacionales',       'Bases de Dades Relacionals',         8],
            [1, '24/CIFOFSE-PD/109/2457820/009', 'Git y Control de Versiones',        'Git i Control de Versions',          9],
            [1, '24/CIFOFSE-PD/110/2457821/010', 'Desarrollo Web con Vue',            'Desenvolupament Web amb Vue',        10],
            [1, '25/CIFOFSE-PD/111/2457822/011', 'DevOps Inicial',                    'DevOps Inicial',                    11],
            [1, '25/CIFOFSE-PD/112/2457823/012', 'Programación Orientada a Objetos',  'Programació Orientada a Objectes',  12],
            [1, '23/CIFOFSE-PD/113/2457824/013', 'Docker y Contenedores',             'Docker i Contenidors',              13],
            [1, '24/CIFOFSE-PD/114/2457825/014', 'Testing Automatizado',              'Testing Automatitzat',              14],
            [2, '22/CIFOFSE-CS/201/3457812/015', 'Seguridad en Redes',                'Seguretat en Xarxes',               15],
            [2, '23/CIFOFSE-CS/202/3457813/016', 'Hacking Ético Básico',              'Hacking Ètic Bàsic',                 1],
            [3, '24/CIFOFSE-TE/301/4457812/017', 'Introducción a Inteligencia Artificial', 'Introducció a la Intel·ligència Artificial', 2],
            [3, '25/CIFOFSE-TE/302/4457813/018', 'IoT con Sensores',                  'IoT amb Sensors',                    3],
            [4, '24/CIFOFSE-CD/401/5457812/019', 'UX UI para Aplicaciones',           'UX UI per a Aplicacions',            4],
            [4, '25/CIFOFSE-CD/402/5457813/020', 'Herramientas Digitales Colaborativas', 'Eines Digitals Col·laboratives',  5],
        ];

        foreach ($courses as [$categoryId, $code, $nameEs, $nameCa, $teacherId]) {
            $course = Course::create([
                'category_id' => $categoryId,
                'course_code' => $code,
                'name' => ['es' => $nameEs, 'ca' => $nameCa],
            ]);

            $course->teachers()->attach($teacherId);
        }
    }
}
