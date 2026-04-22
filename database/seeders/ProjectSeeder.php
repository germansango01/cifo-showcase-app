<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Student;
use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // ── Professors ────────────────────────────────────────
        $professors = collect([
            ['name' => 'Carlos Martínez', 'email' => 'carlos.martinez@cifo.cat', 'department' => 'DAW'],
            ['name' => 'Laura Sánchez',   'email' => 'laura.sanchez@cifo.cat',   'department' => 'DAM'],
            ['name' => 'Jordi Vila',      'email' => 'jordi.vila@cifo.cat',      'department' => 'ASIR'],
            ['name' => 'Ana Ruiz',        'email' => 'ana.ruiz@cifo.cat',        'department' => 'SMX'],
        ])->mapWithKeys(fn ($data) => [
            Str::slug($data['name']) => Professor::firstOrCreate(['email' => $data['email']], $data),
        ]);

        // ── Technologies ──────────────────────────────────────
        $techs = collect([
            'Laravel', 'Vue.js', 'React', 'PHP', 'JavaScript', 'TypeScript',
            'Python', 'Java', 'Kotlin', 'Swift', 'Docker', 'Linux',
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis',
            'Tailwind CSS', 'Bootstrap', 'Flutter', 'Android',
            'Node.js', 'Express', 'REST API', 'GraphQL',
            'Arduino', 'Raspberry Pi', 'IoT', 'MQTT',
            'Wireshark', 'Grafana', 'Prometheus',
        ])->mapWithKeys(fn ($name) => [
            $name => Technology::firstOrCreate(['name' => $name]),
        ]);

        // ── Tags ──────────────────────────────────────────────
        $tags = collect([
            'web', 'mobile', 'iot', 'cloud', 'seguridad',
            'salud', 'sostenibilidad', 'educación', 'soporte-técnico', 'monitorización',
        ])->mapWithKeys(fn ($slug) => [
            $slug => Tag::firstOrCreate(['slug' => $slug], ['name' => ucfirst(str_replace('-', ' ', $slug))]),
        ]);

        // ── Projects data (from static HTML) ─────────────────
        $projects = [
            [
                'title' => 'MedTrack — Gestión de Citas Médicas',
                'short_description' => 'Aplicación web para gestionar citas médicas con calendario interactivo y notificaciones en tiempo real.',
                'description' => 'MedTrack es una plataforma integral de gestión sanitaria que permite a pacientes y profesionales médicos coordinar citas de manera eficiente. Incluye un calendario interactivo con drag & drop, sistema de notificaciones push, historial clínico del paciente y un dashboard analítico para el centro médico. Desarrollado con Laravel y Vue.js, implementa autenticación multifactor y cumple con la normativa RGPD para datos sensibles.',
                'cycle' => 'DAW',
                'year' => 2025,
                'professor' => 'carlos-martinez',
                'student' => ['name' => 'Marina López García',    'email' => 'marina.lopez@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/medtrack/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                'tags' => ['web', 'salud'],
                'images' => ['medtrack1', 'medtrack2', 'medtrack3'],
            ],
            [
                'title' => 'EcoRuta — Rutas Sostenibles BCN',
                'short_description' => 'App móvil de rutas urbanas sostenibles con gamificación y huella de carbono en tiempo real.',
                'description' => 'EcoRuta es una aplicación móvil que permite a los usuarios de Barcelona descubrir rutas urbanas sostenibles a pie, en bicicleta o transporte público. Incluye un sistema de gamificación con logros y ranking, cálculo de huella de carbono ahorrada, y datos en tiempo real de la qualitat de l\'aire. Desarrollado con Flutter y una API REST en Laravel.',
                'cycle' => 'DAM',
                'year' => 2025,
                'professor' => 'laura-sanchez',
                'student' => ['name' => 'Adrià Puig Fernández',   'email' => 'adria.puig@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/ecoruta/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Flutter', 'Laravel', 'REST API', 'MySQL'],
                'tags' => ['mobile', 'sostenibilidad'],
                'images' => ['ecoruta1', 'ecoruta2'],
            ],
            [
                'title' => 'ShieldNet — Monitor de Red Empresarial',
                'short_description' => 'Sistema de monitorización de red con detección de anomalías y alertas automatizadas.',
                'description' => 'ShieldNet es un sistema de monitorización de infraestructura de red que detecta anomalías de tráfico y genera alertas automatizadas. Usa análisis de paquetes con Wireshark, dashboards en tiempo real con Grafana + Prometheus, y notificaciones vía email y Slack. Desplegado sobre Debian con Docker Compose.',
                'cycle' => 'ASIR',
                'year' => 2024,
                'professor' => 'jordi-vila',
                'student' => ['name' => 'Fatima El Amrani',       'email' => 'fatima.elamrani@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/shieldnet/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Docker', 'Linux', 'Grafana', 'Prometheus', 'Wireshark'],
                'tags' => ['seguridad', 'monitorització'],
                'images' => ['shieldnet1', 'shieldnet2'],
            ],
            [
                'title' => 'GreenHouse — Monitorización IoT',
                'short_description' => 'Sistema IoT para monitorizar temperatura, humedad y riego de invernaderos con dashboard en tiempo real.',
                'description' => 'GreenHouse conecta sensores de temperatura, humedad y nivel de agua en un invernadero agrícola a través de MQTT y Raspberry Pi. Los datos se visualizan en un dashboard web con gráficas históricas y alertas configurables. El sistema de riego se activa automáticamente según umbrales predefinidos. Desarrollado con Python, Node.js y un frontend en React.',
                'cycle' => 'DAM',
                'year' => 2025,
                'professor' => 'laura-sanchez',
                'student' => ['name' => 'Laia Ferrer Bosch',      'email' => 'laia.ferrer@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/greenhouse/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Raspberry Pi', 'Python', 'MQTT', 'React', 'Node.js'],
                'tags' => ['iot', 'sostenibilitat', 'monitorització'],
                'images' => ['greenhouse1', 'greenhouse2'],
            ],
            [
                'title' => 'TechRepair — Gestión de Incidencias IT',
                'short_description' => 'Plataforma de ticketing para soporte técnico con priorización automática y base de conocimiento.',
                'description' => 'TechRepair es un sistema de gestión de incidencias para departamentos de soporte técnico. Incluye priorización automática por IA de reglas, base de conocimiento colaborativa, SLA tracking y reportes de rendimiento por técnico. Desarrollado en PHP con Laravel y Bootstrap.',
                'cycle' => 'SMX',
                'year' => 2025,
                'professor' => 'ana-ruiz',
                'student' => ['name' => 'Sergio Navarro Díaz',    'email' => 'sergio.navarro@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/techrepair/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Bootstrap'],
                'tags' => ['web', 'soporte-tecnico'],
                'images' => ['techrepair1', 'techrepair2'],
            ],
            [
                'title' => 'CloudDesk — Escritorio Virtual Educativo',
                'short_description' => 'Infraestructura de escritorios virtuales para aulas informáticas con gestión centralizada.',
                'description' => 'CloudDesk implementa una infraestructura VDI (Virtual Desktop Infrastructure) para aulas informáticas usando Proxmox VE y thin clients. Permite a los administradores clonar, configurar y desplegar escritorios virtuales a decenas de alumnos simultáneamente. Incluye panel de administración web para gestión de usuarios y recursos.',
                'cycle' => 'ASIR',
                'year' => 2025,
                'professor' => 'jordi-vila',
                'student' => ['name' => 'Omar Benítez Torres',    'email' => 'omar.benitez@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/clouddesk/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => true,
                'technologies' => ['Linux', 'Docker', 'Python', 'PHP'],
                'tags' => ['cloud', 'educacion'],
                'images' => ['clouddesk1', 'clouddesk2'],
            ],
            [
                'title' => 'FormFlow — Generador de Formularios',
                'short_description' => 'Herramienta drag & drop para crear formularios web con lógica condicional y exportación de datos.',
                'description' => 'FormFlow es un builder visual de formularios web que permite definir campos, validaciones y lógica condicional sin escribir código. Los formularios generados son embebibles vía iframe o script, con exportación de respuestas en CSV/Excel y notificaciones por email. Desarrollado con Vue.js y Laravel.',
                'cycle' => 'DAW',
                'year' => 2025,
                'professor' => 'carlos-martinez',
                'student' => ['name' => 'Paula Gómez Ibáñez',    'email' => 'paula.gomez@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/formflow/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => false,
                'technologies' => ['Vue.js', 'Laravel', 'MySQL', 'JavaScript'],
                'tags' => ['web'],
                'images' => ['formflow1', 'formflow2'],
            ],
            [
                'title' => 'StockPulse — Control de Inventario',
                'short_description' => 'App Android para gestión de inventario con lectura de códigos QR y sincronización en la nube.',
                'description' => 'StockPulse es una aplicación Android para la gestión de inventario en pequeñas y medianas empresas. Permite registrar entradas y salidas de stock mediante lectura QR/código de barras, con sincronización en tiempo real a una API REST en Spring Boot y almacenamiento en PostgreSQL.',
                'cycle' => 'DAM',
                'year' => 2024,
                'professor' => 'laura-sanchez',
                'student' => ['name' => 'Javier Morales Cruz',   'email' => 'javier.morales@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/stockpulse/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => false,
                'technologies' => ['Android', 'Kotlin', 'REST API', 'PostgreSQL'],
                'tags' => ['mobile'],
                'images' => ['stockpulse1'],
            ],
            [
                'title' => 'NetWarden — Auditoría de Seguridad',
                'short_description' => 'Script automatizado de auditoría de seguridad para redes corporativas con reporte PDF.',
                'description' => 'NetWarden es una suite de herramientas Python para auditoría de seguridad en redes corporativas. Realiza escaneo de puertos, detección de servicios vulnerables, análisis de configuraciones de firewall y genera un informe PDF detallado con severidad CVSS. Pensado para pentesters internos y administradores de sistemas.',
                'cycle' => 'ASIR',
                'year' => 2024,
                'professor' => 'jordi-vila',
                'student' => ['name' => 'Yasmin Okafor Nduka',   'email' => 'yasmin.okafor@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/netwarden/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => false,
                'technologies' => ['Python', 'Linux', 'Docker'],
                'tags' => ['seguridad'],
                'images' => ['netwarden1'],
            ],
            [
                'title' => 'HelpDesk SMX — Portal de Soporte',
                'short_description' => 'Portal web de autoayuda y soporte técnico para usuarios finales de una empresa.',
                'description' => 'HelpDesk SMX es un portal de autoayuda corporativo con base de conocimiento, sistema de tickets y chat básico entre usuario y técnico. Incluye una app complementaria para que los técnicos gestionen incidencias desde el móvil. Desarrollado con PHP nativo y una app Android en Kotlin.',
                'cycle' => 'SMX',
                'year' => 2024,
                'professor' => 'ana-ruiz',
                'student' => ['name' => 'Raúl Castillo Vega',    'email' => 'raul.castillo@alumnes.cifo.cat'],
                'thumbnail_url' => 'https://picsum.photos/seed/helpdesk/600/400',
                'demo_url' => null,
                'repo_url' => null,
                'featured' => false,
                'technologies' => ['PHP', 'MySQL', 'Android', 'Kotlin'],
                'tags' => ['web', 'soporte-tecnico', 'mobile'],
                'images' => ['helpdesk1'],
            ],
        ];

        // ── Seed ─────────────────────────────────────────────
        foreach ($projects as $data) {
            $student = Student::firstOrCreate(
                ['email' => $data['student']['email']],
                [
                    'name' => $data['student']['name'],
                    'cycle' => $data['cycle'],
                    'year' => $data['year'],
                ]
            );

            $project = Project::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'student_id' => $student->id,
                    'professor_id' => $professors[$data['professor']]->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'cycle' => $data['cycle'],
                    'year' => $data['year'],
                    'thumbnail_url' => $data['thumbnail_url'],
                    'demo_url' => $data['demo_url'],
                    'repo_url' => $data['repo_url'],
                    'featured' => $data['featured'],
                ]
            );

            // Images
            foreach ($data['images'] as $i => $seed) {
                ProjectImage::firstOrCreate(
                    ['project_id' => $project->id, 'sort_order' => $i],
                    [
                        'url' => "https://picsum.photos/seed/{$seed}/1200/800",
                        'alt' => "Captura {$i} de {$project->title}",
                        'sort_order' => $i,
                    ]
                );
            }

            // Technologies
            $techIds = collect($data['technologies'])
                ->map(fn ($name) => $techs[$name]->id)
                ->toArray();
            $project->technologies()->syncWithoutDetaching($techIds);

            // Tags (only create tag entries that actually exist in our $tags map)
            $tagIds = collect($data['tags'])
                ->filter(fn ($slug) => isset($tags[$slug]))
                ->map(fn ($slug) => $tags[$slug]->id)
                ->toArray();
            $project->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
