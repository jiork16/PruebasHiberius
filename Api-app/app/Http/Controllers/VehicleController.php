<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\VehicleResource;

class VehicleController extends Controller
{
    public function index(){
        $query = VehicleResource::collection(
                    QueryBuilder::for(Vehicle::class)
                )->response()->getData(true);
        return $this->success(
            [
                'Vehicles'=> $query['data'],
                'meta'=>$query['meta']
            ],
            $this->foundNMessage($query['meta']['total'],'driver','vehicles'));
    }
    /**
     * @author Jordan Rodriguez
     * Guarda un vehículo.
     * Los campos se validan con la clase CreateVehicleRequest.
     * @param App\Http\Requests\Vehicle\CreateVehicleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateVehicleRequest $request){
        $data = $request->validated();
        
        $vehicle = Vehicle::create($data);
        
        return empty($vehicle)
            ?   $this->error(500,"No se pudo crear el vehículo.")
            :   $this->success([
                    'vehicle' =>new VehicleResource($vehicle)
                ],
                'Se creó el vehículo #'.$vehicle->id,
                201
        );
    }
    
    /**
     * @author Jordan Rodriguez
     * Actualizacion de datos en la tabla vehicles usando el modelo Vehicle
     * Esta esliminacion se hace de manera logica
     * @param App\Http\Requests\Vehicle\UpdateVehicleRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateVehicleRequest $request, int $id){
        try {
            
            $validated = $request->validated();

            $vehicle = Vehicle::find($id);
            
            if(empty($vehicle)){
                return $this->error(404,"No se encontró un registro de vehiculos.");
            }
            $vehicle->update($validated);

            return $this->success(
                ['drive' =>new VehicleResource($vehicle)],
                'Se actualizó el vehiculo #'.$vehicle->id,200);

        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }

    /**
     * @author Jordan Rodriguez
     * Eliminacion de un registro en la tabla de vehicles usando el modelo Driver
     * Esta esliminacion se hace de manera logica
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function delete(int $id){
        try {
            $vehicle = Vehicle::find($id);
            if(empty($vehicle)){
                return $this->error(404,"No se encontró un registro del conductor.");
            }
            $vehicle->delete();
            return $this->success(
                [$vehicle],
                'Eliminacion de Conductor');
        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }
    /**
     * @author Jordan Rodriguez
     * Listado de los conductores disponibles por fecha
     * @param string $date
     * @return \Illuminate\Http\JsonResponse
    */
    public function FreeVehicles($date){
        try {
            $vehicles = Vehicle::FreeVehicles($date)->get();
            if(empty($vehicles)){
                return $this->error(404,"No se encontró conductores disponibles.");
            }
            return $this->success(
                ['vehicles' =>new VehicleResource($vehicles)],
                'Total de vehiculo(s) '. $vehicles->count() ,200);
        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }
}
