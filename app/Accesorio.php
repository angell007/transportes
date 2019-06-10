<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kjjdion\Laracrud\Traits\ColumnFillable;

class Accesorio extends Model
{
    use ColumnFillable;

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_placa','placa');
    }
}
