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

    public function scopeFreeVehicles($query, $date)
    {
        return $query->whereDoesntHave('trips', function ($subquery) use ($date){
            $subquery->whereDate('date', $date);
        });
    }
}
