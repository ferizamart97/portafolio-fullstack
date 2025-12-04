<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | work_modes
        |--------------------------------------------------------------------------
        */
        DB::table('work_modes')->insert([
            [
                'slug'        => 'full-time-job',
                'name'        => 'Trabajo de tiempo completo',
                'description' => 'Proyectos realizados como desarrollador de planta dentro de una empresa.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'freelance-consulting',
                'name'        => 'Freelance / Consultoría',
                'description' => 'Proyectos realizados de forma independiente para clientes y empresas.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'side-project',
                'name'        => 'Proyecto personal',
                'description' => 'Proyectos creados para aprender, experimentar y mejorar habilidades técnicas.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'open-source',
                'name'        => 'Contribución open source',
                'description' => 'Participación en repositorios públicos y proyectos de la comunidad.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'internship',
                'name'        => 'Prácticas profesionales',
                'description' => 'Experiencias realizadas durante periodos de prácticas o trainee.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | solution_types
        |--------------------------------------------------------------------------
        */
        DB::table('solution_types')->insert([
            [
                'slug'        => 'sitio-web-corporativo',
                'name'        => 'Sitio web corporativo',
                'description' => 'Sitios web informativos que presentan a una marca, empresa o profesional.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'landing-page',
                'name'        => 'Landing page',
                'description' => 'Páginas enfocadas en una sola acción: registro, venta o contacto.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'sistema-interno',
                'name'        => 'Sistema interno / Intranet',
                'description' => 'Herramientas para automatizar procesos internos de una empresa.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'ecommerce',
                'name'        => 'Tienda en línea / E-commerce',
                'description' => 'Plataformas para vender productos o servicios en línea.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'api-rest',
                'name'        => 'API REST',
                'description' => 'Backends y APIs para integraciones con otras aplicaciones y servicios.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | industries
        |--------------------------------------------------------------------------
        */
        DB::table('industries')->insert([
            [
                'slug'        => 'viajes-turismo',
                'name'        => 'Viajes y turismo',
                'description' => 'Proyectos relacionados con agencias de viajes, reservaciones y turismo.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'banca-finanzas',
                'name'        => 'Banca y finanzas',
                'description' => 'Soluciones para instituciones financieras, banca digital y pagos.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'tecnologia',
                'name'        => 'Tecnología y software',
                'description' => 'Proyectos enfocados en desarrollo de software y herramientas digitales.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'educacion',
                'name'        => 'Educación',
                'description' => 'Plataformas de aprendizaje, cursos en línea y material educativo.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'slug'        => 'pymes-servicios',
                'name'        => 'PyMEs y servicios',
                'description' => 'Soluciones a la medida para pequeños negocios y proveedores de servicios.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | projects
        |
        | Asume:
        |   work_modes IDs: 1..5
        |   experiences IDs: 1..5 (de tu ExperienceSeeder)
        |--------------------------------------------------------------------------
        */
        DB::table('projects')->insert([
            [
                'name'               => 'Portafolio Web Personal',
                'client_name'        => null,
                'slug'               => 'portafolio-web-personal',
                'main_image_path'    => 'storage/projects/portafolio-web-personal.png',
                'short_description'  => 'Portafolio web desarrollado con Angular y Laravel para mostrar proyectos, experiencia y servicios.',
                'repository_url'     => 'https://github.com/ferizamart97/portfolio-web',
                'is_active'          => true,
                'is_featured'        => true,
                'work_mode_id'       => 3, // side-project
                'experience_id'      => 3, // I&M Development Studio
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Sistema de Caja para PyME',
                'client_name'        => 'Sistema Caja MX',
                'slug'               => 'sistema-caja-pyme',
                'main_image_path'    => 'storage/projects/sistema-caja-pyme.png',
                'short_description'  => 'Aplicación web para gestión de contratos, pagos, estados de cuenta y clientes para una PyME.',
                'repository_url'     => null,
                'is_active'          => true,
                'is_featured'        => true,
                'work_mode_id'       => 2, // freelance
                'experience_id'      => 3, // I&M Development Studio
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Intranet BEyG 2.0',
                'client_name'        => 'BBVA',
                'slug'               => 'intranet-beyg-2-0',
                'main_image_path'    => 'storage/projects/intranet-beyg-2-0.png',
                'short_description'  => 'Intranet corporativa para la gestión de contenidos internos, roles y accesos para áreas de negocio.',
                'repository_url'     => null,
                'is_active'          => true,
                'is_featured'        => false,
                'work_mode_id'       => 1, // full-time
                'experience_id'      => 2, // BBVA proyecto
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Portal de Viajes Euromundo',
                'client_name'        => 'Euromundo Viajes',
                'slug'               => 'portal-viajes-euromundo',
                'main_image_path'    => 'storage/projects/portal-viajes-euromundo.png',
                'short_description'  => 'Portal web para consulta de paquetes turísticos, destinos y promociones de viaje.',
                'repository_url'     => null,
                'is_active'          => true,
                'is_featured'        => false,
                'work_mode_id'       => 1, // full-time
                'experience_id'      => 5, // Euromundo
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Landing Agencia Creativa Zaza',
                'client_name'        => 'Agencia Creativa Zaza',
                'slug'               => 'landing-agencia-creativa-zaza',
                'main_image_path'    => 'storage/projects/landing-agencia-creativa-zaza.png',
                'short_description'  => 'Landing page enfocada en conversión para una agencia creativa, con énfasis en branding y velocidad.',
                'repository_url'     => 'https://github.com/ferizamart97/landing-agencia-zaza',
                'is_active'          => true,
                'is_featured'        => true,
                'work_mode_id'       => 2, // freelance
                'experience_id'      => 4, // Agencia Creativa Zaza
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | project_solution_types (pivot)
        | Asume projects IDs: 1..5  y solution_types IDs: 1..5
        |--------------------------------------------------------------------------
        */
        DB::table('project_solution_types')->insert([
            // Portafolio: sitio corporativo + landing
            [
                'project_id'        => 1,
                'solution_type_id'  => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'project_id'        => 1,
                'solution_type_id'  => 2,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Sistema de caja: sistema interno + API
            [
                'project_id'        => 2,
                'solution_type_id'  => 3,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'project_id'        => 2,
                'solution_type_id'  => 5,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Intranet BEyG: sistema interno
            [
                'project_id'        => 3,
                'solution_type_id'  => 3,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Portal viajes: corporativo + ecommerce
            [
                'project_id'        => 4,
                'solution_type_id'  => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'project_id'        => 4,
                'solution_type_id'  => 4,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Landing Agencia Zaza: landing page
            [
                'project_id'        => 5,
                'solution_type_id'  => 2,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | project_industry (pivot)
        | Asume industries IDs: 1..5
        |--------------------------------------------------------------------------
        */
        DB::table('project_industry')->insert([
            // Portafolio: tecnología + PyMEs
            [
                'project_id'   => 1,
                'industry_id'  => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'project_id'   => 1,
                'industry_id'  => 5,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            // Sistema de caja: PyMEs y servicios
            [
                'project_id'   => 2,
                'industry_id'  => 5,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            // Intranet BEyG: banca
            [
                'project_id'   => 3,
                'industry_id'  => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            // Portal viajes: viajes y turismo
            [
                'project_id'   => 4,
                'industry_id'  => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            // Landing Agencia: PyMEs y servicios
            [
                'project_id'   => 5,
                'industry_id'  => 5,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | certifications
        |--------------------------------------------------------------------------
        */
        DB::table('certifications')->insert([
            [
                'name'                   => 'Certificación Java SE 11 Developer',
                'short_description'      => 'Certificación orientada a la programación con Java, POO, colecciones y buenas prácticas.',
                'name_institution'       => 'Oracle',
                'url_institution'        => 'https://education.oracle.com',
                'slug'                   => 'certificacion-java-se-11-developer',
                'main_image_path'        => 'storage/certifications/java-se-11.png',
                'date_certification'     => '2023-06-15',
                'date_end_certification' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'name'                   => 'Angular Frontend Developer',
                'short_description'      => 'Curso completo de Angular con componentes, servicios, routing y consumo de APIs REST.',
                'name_institution'       => 'Udemy',
                'url_institution'        => 'https://www.udemy.com',
                'slug'                   => 'angular-frontend-developer',
                'main_image_path'        => 'storage/certifications/angular-frontend.png',
                'date_certification'     => '2022-11-10',
                'date_end_certification' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'name'                   => 'Laravel Backend Developer',
                'short_description'      => 'Profundización en Laravel, migraciones, Eloquent, colas, APIs y autenticación.',
                'name_institution'       => 'Platzi',
                'url_institution'        => 'https://platzi.com',
                'slug'                   => 'laravel-backend-developer',
                'main_image_path'        => 'storage/certifications/laravel-backend.png',
                'date_certification'     => '2022-05-20',
                'date_end_certification' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'name'                   => 'AWS Cloud Practitioner Essentials',
                'short_description'      => 'Fundamentos de AWS, servicios básicos y buenas prácticas en la nube.',
                'name_institution'       => 'AWS Training',
                'url_institution'        => 'https://www.aws.training',
                'slug'                   => 'aws-cloud-practitioner-essentials',
                'main_image_path'        => 'storage/certifications/aws-cloud-practitioner.png',
                'date_certification'     => '2023-03-01',
                'date_end_certification' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'name'                   => 'Database Design & SQL',
                'short_description'      => 'Curso de modelado de bases de datos relacionales y SQL aplicado a proyectos reales.',
                'name_institution'       => 'Coursera',
                'url_institution'        => 'https://www.coursera.org',
                'slug'                   => 'database-design-sql',
                'main_image_path'        => 'storage/certifications/database-design-sql.png',
                'date_certification'     => '2021-09-10',
                'date_end_certification' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | skills
        |--------------------------------------------------------------------------
        */
        DB::table('skills')->insert([
            [
                'name'       => 'Java',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Angular',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Vue.js',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'MySQL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | testimonials
        |--------------------------------------------------------------------------
        */
        DB::table('testimonials')->insert([
            [
                'name'              => 'Paola Carolina',
                'company_name'      => 'Agencia de Viajes Nomitek',
                'position'          => 'Directora',
                'short_description' => 'El proyecto superó nuestras expectativas, ahora podemos gestionar reservas y clientes de forma mucho más ágil.',
                'main_image_path'   => 'storage/testimonials/paola-carolina.png',
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Sajid Khan',
                'company_name'      => 'KODE IT',
                'position'          => 'CTO',
                'short_description' => 'Demostró un gran dominio de las tecnologías web modernas y una excelente comunicación durante todo el proyecto.',
                'main_image_path'   => 'storage/testimonials/sajid-khan.png',
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Angie Ramírez',
                'company_name'      => 'Agencia Creativa Zaza',
                'position'          => 'CEO',
                'short_description' => 'La landing page ayudó a aumentar nuestras conversiones y refleja perfectamente nuestra identidad de marca.',
                'main_image_path'   => 'storage/testimonials/angie-ramirez.png',
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Javier López',
                'company_name'      => 'Consultoría López',
                'position'          => 'Director General',
                'short_description' => 'Siempre estuvo dispuesto a proponer mejoras técnicas que terminaron mejorando el rendimiento del sistema.',
                'main_image_path'   => 'storage/testimonials/javier-lopez.png',
                'is_active'         => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'María González',
                'company_name'      => 'EduTech MX',
                'position'          => 'Project Manager',
                'short_description' => 'El sistema educativo desarrollado fue muy bien recibido por nuestros alumnos y equipo interno.',
                'main_image_path'   => 'storage/testimonials/maria-gonzalez.png',
                'is_active'         => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | tools
        |--------------------------------------------------------------------------
        */
        DB::table('tools')->insert([
            [
                'name'                     => 'Laravel',
                'type'                     => 'Backend',
                'main_logo_path'           => 'storage/tools/laravel-primary.svg',
                'main_logo_secondary_path' => 'storage/tools/laravel-secondary.svg',
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'name'                     => 'Angular',
                'type'                     => 'Frontend',
                'main_logo_path'           => 'storage/tools/angular-primary.svg',
                'main_logo_secondary_path' => 'storage/tools/angular-secondary.svg',
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'name'                     => 'Vue.js',
                'type'                     => 'Frontend',
                'main_logo_path'           => 'storage/tools/vue-primary.svg',
                'main_logo_secondary_path' => 'storage/tools/vue-secondary.svg',
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'name'                     => 'Docker',
                'type'                     => 'DevOps',
                'main_logo_path'           => 'storage/tools/docker-primary.svg',
                'main_logo_secondary_path' => 'storage/tools/docker-secondary.svg',
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'name'                     => 'GitHub Actions',
                'type'                     => 'CI/CD',
                'main_logo_path'           => 'storage/tools/github-actions-primary.svg',
                'main_logo_secondary_path' => 'storage/tools/github-actions-secondary.svg',
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | education
        |--------------------------------------------------------------------------
        */
        DB::table('education')->insert([
            [
                'institution_name'       => 'Universidad de Tecnología de México',
                'degree_title'           => 'Licenciatura en Gestión y Desarrollo de Software',
                'field'                  => 'Desarrollo de Software',
                'level'                  => 'Licenciatura',
                'start_date'             => '2016-08-01',
                'end_date'               => '2020-06-30',
                'location'               => 'Ciudad de México, MX',
                'short_description'      => 'Formación en desarrollo de software, bases de datos, ingeniería de software y metodologías ágiles.',
                'institution_url'        => 'https://www.unitec.mx',
                'institution_logo_path'  => 'storage/education/universidad-tecnologia.png',
                'social_links'           => json_encode([
                    'website'  => 'https://www.unitec.mx',
                    'linkedin' => 'https://www.linkedin.com/school/unitec-mx/',
                ]),
                'is_current'             => false,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'institution_name'       => 'Platzi',
                'degree_title'           => 'Carrera de Desarrollo Backend con Java',
                'field'                  => 'Backend con Java y Spring',
                'level'                  => 'Certificación',
                'start_date'             => '2022-01-01',
                'end_date'               => '2022-06-30',
                'location'               => 'Online',
                'short_description'      => 'Ruta de aprendizaje enfocada en Java, Spring, bases de datos y despliegue en producción.',
                'institution_url'        => 'https://platzi.com',
                'institution_logo_path'  => 'storage/education/platzi.png',
                'social_links'           => json_encode([
                    'website'  => 'https://platzi.com',
                    'twitter'  => 'https://twitter.com/platzi',
                ]),
                'is_current'             => false,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'institution_name'       => 'Udemy',
                'degree_title'           => 'Angular de 0 a Experto',
                'field'                  => 'Frontend Angular',
                'level'                  => 'Certificación',
                'start_date'             => '2021-03-01',
                'end_date'               => '2021-07-01',
                'location'               => 'Online',
                'short_description'      => 'Curso intensivo para dominar Angular, componentes, servicios, routing y buenas prácticas.',
                'institution_url'        => 'https://www.udemy.com',
                'institution_logo_path'  => 'storage/education/udemy.png',
                'social_links'           => json_encode([
                    'website' => 'https://www.udemy.com',
                ]),
                'is_current'             => false,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'institution_name'       => 'Coursera',
                'degree_title'           => 'Algorithms and Data Structures',
                'field'                  => 'Computer Science',
                'level'                  => 'Curso especializado',
                'start_date'             => '2020-09-01',
                'end_date'               => '2021-01-15',
                'location'               => 'Online',
                'short_description'      => 'Fundamentos de estructuras de datos, algoritmos y resolución de problemas.',
                'institution_url'        => 'https://www.coursera.org',
                'institution_logo_path'  => 'storage/education/coursera.png',
                'social_links'           => json_encode([
                    'website' => 'https://www.coursera.org',
                ]),
                'is_current'             => false,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
            [
                'institution_name'       => 'Academia Online',
                'degree_title'           => 'Inglés para Desarrolladores',
                'field'                  => 'Idiomas',
                'level'                  => 'Curso en progreso',
                'start_date'             => '2024-01-01',
                'end_date'               => null,
                'location'               => 'Online',
                'short_description'      => 'Curso orientado a mejorar el inglés técnico para documentación, entrevistas y trabajo remoto.',
                'institution_url'        => 'https://academia-online.example.com',
                'institution_logo_path'  => 'storage/education/academia-online.png',
                'social_links'           => json_encode([
                    'website' => 'https://academia-online.example.com',
                ]),
                'is_current'             => true,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
        ]);
    }
}
