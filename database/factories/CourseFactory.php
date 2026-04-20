<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Cycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $cursos = [
            "Desarrollo de Páginas Web Prácticas con HTML, CSS y PHP",
            "Construcción de Aplicaciones CRUD con PHP y MySQL",
            "Maquetación Web Responsiva con HTML5, CSS3 y Bootstrap",
            "Programación Básica con PHP Aplicada a Proyectos Reales",
            "Automatización de Procesos de Oficina con PHP y Excel",
            "Creación de Formularios Funcionales y Validaciones con PHP",
            "Gestión y Manipulación de Datos con PHP y MySQL",
            "Desarrollo de Paneles Administrativos con PHP",
            "Integración de JavaScript y PHP en Aplicaciones Web",
            "Consumo e Implementación de APIs REST con PHP",
            "Generación de Reportes Automáticos con PHP y Excel",
            "Control de Versiones en Proyectos Reales con Git",
            "Implementación de Sistemas de Login y Registro con PHP",
            "Desarrollo de Sitios Web Dinámicos desde Cero",
            "Procesamiento de Archivos (CSV, Excel, PDF) con PHP",
            "Desarrollo de Mini Proyectos Full Stack (Frontend + Backend)",
            "Validación y Seguridad Básica en Formularios Web",
            "Despliegue Básico de Aplicaciones Web en Servidores",
            "Optimización Práctica de Rendimiento en PHP",
            "Mantenimiento y Mejora de Aplicaciones Web Existentes"
        ];
        return [
            'cycle_id' => Cycle::factory(),
            'user_id' => User::factory(),
            // 'name' => $this->faker->sentence(3),
            'name' => $this->faker->randomElement($cursos),
            'academic_year' => $this->faker->randomElement([
                '2023-2024',
                '2024-2025',
                '2025-2026',
            ]),
        ];
    }
}
