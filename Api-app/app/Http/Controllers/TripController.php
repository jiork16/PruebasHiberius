<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Resources\TripResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\Trip\CreateTripRequest;
use App\Http\Requests\Trip\DeleteTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;

class TripController extends Controller
{
    public function index(){
        $query = TripResource::collection(
                    QueryBuilder::for(Trip::class)
                )->response()->getData(true);
        return $this->success(
            [
                'Trips'=> $query['data'],
                'meta'=>$query['meta']
            ],
            $this->foundNMessage($query['meta']['total'],'Trip','trips'));
    }
    /**
     * @author Jordan Rodriguez
     * Guarda un conductor.
     * Los campos se validan con la clase CreateTripeRequest.
     * @param App\Http\Requests\Trip\CreateTripeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTripRequest $request){
        $data = $request->validated();
        
        $drive = Trip::create($data);
        
        return empty($drive)
            ?   $this->error(500,"No se pudo crear el conductor.")
            :   $this->success([
                    'drive' =>new TripResource($drive)
                ],
                'Se creó el conductor #'.$drive->id,
                201
        );
    }
    
    /**
     * @author Jordan Rodriguez
     * Actualizacion de datos en la tabla trips usando el modelo Trip
     * Esta esliminacion se hace de manera logica
     * @param App\Http\Requests\Trip\UpdateTripeRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateTripRequest $request, int $id){
        try {
            
            $validated = $request->validated();

            $trip = Trip::find($id);
            
            if(empty($trip)){
                return $this->error(404,"No se encontró un registro de conductor.");
            }
            $trip->update($validated);

            return $this->success(
                ['trip' =>new TripResource($trip)],
                'Se actualizó el viaje #'.$trip->id,200);

        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }

    /**
     * @author Jordan Rodriguez
     * Eliminacion de un registro en la tabla de trips usando el modelo Trip
     * Esta esliminacion se hace de manera logica
     * @param int vehicle_id
     * @param int driver_id
     * @param int date
     * @return \Illuminate\Http\JsonResponse
    */
    public function delete(int $vehicle_id, int $driver_id, $date){
        try {
            $trip = Trip::where([
                ['vehicle_id', $vehicle_id],
                ['driver_id', $driver_id],
                ])->whereDate('date', $date);
            if(empty($trip)){
                return $this->error(404,"No se encontró un registro del viaje.");
            }
            $trip->delete();
            return $this->success(
                [$trip],
                'Eliminacion de Conductor');
        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }
    /**
     * @author Jordan Rodriguez
     * Listado de los conductores disponibles por licencia y fecha
     * @param string $license
     * @param string $date
     * @return \Illuminate\Http\JsonResponse
    */
    public function freeDrivers(string $license,$date){
        try {
            $trips = Trip::FreeDrivers($license,$date)->get();
            if(empty($trips)){
                return $this->error(404,"No se encontró viaje disponibles.");
            }
            return $this->success(
                ['drives' =>new TripResource($trips)],
                'Total de Conductore(s) '. $trips->count() ,200);
        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }
}
