<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kjjdion\Laracrud\Traits\ColumnFillable;

class Proveedor extends Model
{
    use ColumnFillable;


    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

}
