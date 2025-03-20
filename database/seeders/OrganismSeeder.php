<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganismSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('organisms')->insert([
            ['id' => 1, 'nombre' => 'Departamento Administrativo de Planeacion Municipal', 'count' => 35],
            ['id' => 2, 'nombre' => 'Departamento Administrativo de Gestion del Medio Ambiente - DAGMA', 'count' => 18],
            ['id' => 3, 'nombre' => 'Secretaria de Infraestructura', 'count' => 2],
            ['id' => 5, 'nombre' => 'Unidad Administrativa Especial de Gestion de Bienes y Servicios', 'count' => 2],
            ['id' => 6, 'nombre' => 'Subdireccion de Catastro', 'count' => 10],
            ['id' => 7, 'nombre' => 'Secretaria del Deporte y la Recreacion', 'count' => 2],
            ['id' => 8, 'nombre' => 'Subdireccion de Tesoreria Municipal', 'count' => 4],
            ['id' => 11, 'nombre' => 'Subdireccion de Impuestos y Rentas', 'count' => 17],
            ['id' => 12, 'nombre' => 'Secretaria de Cultura', 'count' => 2],
            ['id' => 14, 'nombre' => 'Secretaria de Seguridad y Justicia', 'count' => 17],
            ['id' => 16, 'nombre' => 'Secretaria de Movilidad', 'count' => 67],
            ['id' => 17, 'nombre' => 'Secretaria de Vivienda Social y Habitat', 'count' => 5],
            ['id' => 19, 'nombre' => 'Secretaria de Desarrollo Territorial y Participacion Ciudadana', 'count' => 6],
            ['id' => 20, 'nombre' => 'Secretaria de Educacion', 'count' => 24],
            ['id' => 21, 'nombre' => 'Secretaria de Salud Publica', 'count' => 18],
        ]);
        
    }
}
