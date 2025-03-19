<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DependenciaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dependencias')->insert([
            ['id' => 1, 'nombre' => 'Departamento Administrativo de Planeación Municipal', 'count' => 35],
            ['id' => 2, 'nombre' => 'Departamento Administrativo de Gestión del Medio Ambiente - DAGMA', 'count' => 18],
            ['id' => 3, 'nombre' => 'Secretaría de Infraestructura', 'count' => 2],
            ['id' => 5, 'nombre' => 'Unidad Administrativa Especial de Gestión de Bienes y Servicios', 'count' => 2],
            ['id' => 6, 'nombre' => 'Subdirección de Catastro', 'count' => 10],
            ['id' => 7, 'nombre' => 'Secretaría del Deporte y la Recreación', 'count' => 2],
            ['id' => 8, 'nombre' => 'Subdirección de Tesorería Municipal', 'count' => 4],
            ['id' => 11, 'nombre' => 'Subdirección de Impuestos y Rentas', 'count' => 17],
            ['id' => 12, 'nombre' => 'Secretaría de Cultura', 'count' => 2],
            ['id' => 14, 'nombre' => 'Secretaría de Seguridad y Justicia', 'count' => 17],
            ['id' => 16, 'nombre' => 'Secretaría de Movilidad', 'count' => 67],
            ['id' => 17, 'nombre' => 'Secretaría de Vivienda Social y Hábitat', 'count' => 5],
            ['id' => 19, 'nombre' => 'Secretaría de Desarrollo Territorial y Participación Ciudadana', 'count' => 6],
            ['id' => 20, 'nombre' => 'Secretaría de Educación', 'count' => 24],
            ['id' => 21, 'nombre' => 'Secretaría de Salud Pública', 'count' => 18],
        ]);
    }
}
