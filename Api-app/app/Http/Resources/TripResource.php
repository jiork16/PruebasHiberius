<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ret = parent::toArray($request);
        $ret['vehicle']=$this->vehicle;
        $ret['driver']=$this->driver;
        $ret['date']=$this->date;
        return $ret;
    }
}
