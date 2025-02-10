<?php

namespace App\Imports;

use App\Models\ActividadesTransporte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActividadesTransporteImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new ActividadesTransporte([
        return new ActividadesTransporte([
            'id_act_tra' => $row['id_act_tra'], // Nombre de la columna en el CSV
            'nom_con'    => $row['nom_con'],
            'num_ide'    => $row['num_ide'],
            'no_act_tra' => $row['no_act_tra'],
            'fec_pub'    => $row['fec_pub'],
        ]);
    }
}
