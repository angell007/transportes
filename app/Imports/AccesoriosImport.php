<?php

namespace App\Imports;

use App\Accesorio;
use Maatwebsite\Excel\Concerns\ToModel;

class AccesoriosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Accesorio([
                'vehiculo_placa'     => $row[0],
                'descripcion'        => $row[1],
                'disponibilidad'     => $row[2],
                'observacion'        => $row[3]
        ]);
    }
}
