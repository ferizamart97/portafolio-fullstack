<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('experiences')->insert([
            [
                'company_name'        => 'NEORIS',
                'position_title'      => 'Java / Angular Developer',
                'employment_type'     => 'Full-time',
                'start_date'          => '2023-03-01',
                'end_date'            => null,
                'location'            => 'Ciudad de México, MX',
                'short_description'   => 'Desarrollo de aplicaciones web para banca digital usando Java, Spring y Angular. Participación en diseño de arquitectura y buenas prácticas.',
                'company_url'         => 'https://www.neoris.com',
                'company_logo_path'   => 'storage/logos/neoris.png',
                'social_links'        => json_encode([
                    'linkedin' => 'https://www.linkedin.com/company/neoris/',
                    'website'  => 'https://www.neoris.com',
                ]),
                'is_current'          => true,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'company_name'        => 'BBVA (Proyecto tercerizado)',
                'position_title'      => 'Backend Java Developer',
                'employment_type'     => 'Contract',
                'start_date'          => '2022-01-01',
                'end_date'            => '2023-02-28',
                'location'            => 'Remoto / Ciudad de México, MX',
                'short_description'   => 'Mantenimiento y evolución de microservicios en Java 11 sobre Spring Boot, integración con APIs internas y optimización de consultas a bases de datos.',
                'company_url'         => 'https://www.bbva.com',
                'company_logo_path'   => 'storage/logos/bbva.png',
                'social_links'        => json_encode([
                    'linkedin' => 'https://www.linkedin.com/company/bbva/',
                    'website'  => 'https://www.bbva.com',
                ]),
                'is_current'          => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'company_name'        => 'I&M Development Studio',
                'position_title'      => 'Full Stack Web Developer',
                'employment_type'     => 'Freelance',
                'start_date'          => '2021-06-01',
                'end_date'            => null,
                'location'            => 'Remoto',
                'short_description'   => 'Desarrollo de portafolios web, landing pages y sistemas a medida usando Laravel, Vue.js y Angular para pequeños negocios y emprendedores.',
                'company_url'         => 'https://im-devstudio.example.com',
                'company_logo_path'   => 'storage/logos/im-devstudio.png',
                'social_links'        => json_encode([
                    'github'   => 'https://github.com/ferizamart97',
                    'linkedin' => 'https://www.linkedin.com/in/fernando-izazaga/',
                ]),
                'is_current'          => true,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'company_name'        => 'Agencia Creativa Zaza',
                'position_title'      => 'Frontend Developer',
                'employment_type'     => 'Part-time',
                'start_date'          => '2020-09-01',
                'end_date'            => '2021-05-31',
                'location'            => 'Ciudad de México, MX',
                'short_description'   => 'Maquetación de interfaces responsivas con HTML, CSS, JavaScript y Bootstrap. Mejora de performance y accesibilidad.',
                'company_url'         => 'https://agenciazaza.example.com',
                'company_logo_path'   => 'storage/logos/agencia-zaza.png',
                'social_links'        => json_encode([
                    'instagram' => 'https://www.instagram.com/agenciazaza/',
                    'website'   => 'https://agenciazaza.example.com',
                ]),
                'is_current'          => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'company_name'        => 'Euromundo Viajes',
                'position_title'      => 'Intern / Junior Developer',
                'employment_type'     => 'Internship',
                'start_date'          => '2019-02-01',
                'end_date'            => '2020-08-31',
                'location'            => 'Ciudad de México, MX',
                'short_description'   => 'Apoyo en automatización de procesos internos, creación de pequeños módulos web y mantenimiento de sistemas existentes.',
                'company_url'         => 'https://www.euromundo.com.mx',
                'company_logo_path'   => 'storage/logos/euromundo.png',
                'social_links'        => json_encode([
                    'facebook' => 'https://www.facebook.com/euromundoviajes/',
                    'website'  => 'https://www.euromundo.com.mx',
                ]),
                'is_current'          => false,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}
