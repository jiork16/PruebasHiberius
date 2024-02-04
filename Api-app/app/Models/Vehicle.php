<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'license'];
    
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
    /**
     * @author Jordan Rodriguez
     * Retorno los vehiculos libres, se realiza este en forma de scope este metodo
     * para poder ser reutilizable y optimo al generar consultas a la entidad
     */
    public function scopeFreeVehicles($query, $date)
    {
        return $query->whereDoesntHave('trips', function ($subquery) use ($date){
            $subquery->whereDate('date', $date);
        });
    }
}
