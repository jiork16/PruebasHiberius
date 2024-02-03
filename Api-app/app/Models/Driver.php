<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'license'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function scopeFreeDrivers($query, $license, $date)
    {
        return $query->whereDoesntHave('trips', function ($subquery) use($date) {
            $subquery->whereDate('date', $date);
        })
        ->whereExists(function ($subquery) use($license){
            $subquery->selectRaw(1)
                ->from('vehicles')
                ->whereRaw('drivers.license = vehicles.license')
                ->where('vehicles.license', '=', $license);
        });
    }
}
