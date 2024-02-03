<?php

namespace App\Http\Controllers;

use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Requests\Driver\UpdateDriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\DriverResource;


class DriverController extends Controller
{
    /**
     * @author Jordan Rodriguez
     * Retorno los conductores paginados en una colección,
     * @param void
     * @return \Illuminate\Http\JsonResponse
     *
     * Json contiene:
     * conductores -> colección de conductores
     * meta-> información de la paginación
     */
    public function index(){
        $query = DriverResource::collection(
                    QueryBuilder::for(Driver::class)
                    ->paginate(25)
                )->response()->getData(true);
        return $this->success(
            [
                'Drivers'=> $query['data'],
                'meta'=>$query['meta']
            ],
            $this->foundNMessage($query['meta']['total'],'driver','drivers'));
    }
    /**
     * @author Jordan Rodriguez
     * Guarda un conductor.
     * Los campos se validan con la clase CreateDriverRequest.
     * @param App\Http\Requests\Driver\CreateDriverRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDriverRequest $request){
        $data = $request->validated();
        
        $driver = Driver::create($data);
        
        return empty($driver)
            ?   $this->error(500,"No se pudo crear el conductor.")
            :   $this->success([
                    'drivers' =>new DriverResource($driver)
                ],
                'Se creó el conductor #'.$driver->id,
                201
        );
    }
    
    /**
     * @author Jordan Rodriguez
     * Actualizacion de datos en la tabla drivers usando el modelo Driver
     * Esta esliminacion se hace de manera logica
     * @param App\Http\Requests\Driver\UpdateDriverRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateDriverRequest $request, int $id){
        try {
            
            $validated = $request->validated();

            $driver = Driver::find($id);
            
            if(empty($driver)){
                return $this->error(404,"No se encontró un registro de conductor.");
            }
            $driver->update($validated);

            return $this->success(
                ['driver' =>new DriverResource($driver)],
                'Se actualizó el conductor #'.$driver->id,200);

        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }

    /**
     * @author Jordan Rodriguez
     * Eliminacion de un registro en la tabla de drivers usando el modelo Driver
     * Esta esliminacion se hace de manera logica
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function delete(int $id){
        try {
            $driver = Driver::find($id);
            if(empty($driver)){
                return $this->error(404,"No se encontró un registro del conductor.");
            }
            $driver->delete();
            return $this->success(
                [$driver],
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
            $drivers = Driver::FreeDrivers($license,$date)->get();
            if(empty($drivers)){
                return $this->error(404,"No se encontró conductores disponibles.");
            }
            return $this->success(
                ['drivers' =>new DriverResource($drivers)],
                'Total de Conductore(s) '. $drivers->count() ,200);
        } catch (\Exception $th) {
            $_mensaje =  $th->getMessage();
            return $this->error(500,$_mensaje);
        }
    }
}
