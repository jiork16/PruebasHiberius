<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'driver_id','date'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    /**
     * @author Jordan Rodriguez
     * Retorno los viajes existentes
     * para poder ser reutilizable y optimo al generar consultas a la entidad
     */
    public function scopeExistsTrip($query, $vehicle_id, $driver_id, $date)
    {
        return $query->where([
            ['vehicle_id', $vehicle_id],
            ['driver_id', $driver_id],
            ])->whereDate('date', $date);
    }
}
