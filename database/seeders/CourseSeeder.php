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
            [1, 'IFC01010', 'Curso de Laravel Básico',          'Curs de Laravel Bàsic',              1],
            [1, 'IFC01012', 'Fundamentos de Java',               'Fonaments de Java',                  2],
            [1, 'IFC01014', 'Desarrollo Frontend con React',     'Desenvolupament Frontend amb React', 3],
            [1, 'IFC01016', 'Introducción a SQL',                'Introducció a SQL',                  4],
            [1, 'IFC01018', 'Node.js para Principiantes',        'Node.js per a Principiants',         5],
            [1, 'IFC01020', 'Python y Automatización',           'Python i Automatització',            6],
            [1, 'IFC01022', 'APIs REST con Spring Boot',         'APIs REST amb Spring Boot',          7],
            [1, 'IFC01024', 'Bases de Datos Relacionales',       'Bases de Dades Relacionals',         8],
            [1, 'IFC01026', 'Git y Control de Versiones',        'Git i Control de Versions',          9],
            [1, 'IFC01028', 'Desarrollo Web con Vue',            'Desenvolupament Web amb Vue',        10],
            [1, 'IFC01030', 'DevOps Inicial',                    'DevOps Inicial',                    11],
            [1, 'IFC01032', 'Programación Orientada a Objetos',  'Programació Orientada a Objectes',  12],
            [1, 'IFC01034', 'Docker y Contenedores',             'Docker i Contenidors',              13],
            [1, 'IFC01036', 'Testing Automatizado',              'Testing Automatitzat',              14],
            [2, 'IFC02011', 'Seguridad en Redes',                'Seguretat en Xarxes',               15],
            [2, 'IFC02013', 'Hacking Ético Básico',              'Hacking Ètic Bàsic',                 1],
            [3, 'IFC03015', 'Introducción a Inteligencia Artificial', 'Introducció a la Intel·ligència Artificial', 2],
            [3, 'IFC03017', 'IoT con Sensores',                  'IoT amb Sensors',                    3],
            [4, 'IFC04019', 'UX UI para Aplicaciones',           'UX UI per a Aplicacions',            4],
            [4, 'IFC04021', 'Herramientas Digitales Colaborativas', 'Eines Digitals Col·laboratives',  5],
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
