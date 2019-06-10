<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kjjdion\Laracrud\Traits\ColumnFillable;

class Vehiculo extends Model
{
    use ColumnFillable;


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function accesorios()
    {
        return $this->hasMany(Accesorio::class,'vehiculo_placa', 'placa');
    }

}
