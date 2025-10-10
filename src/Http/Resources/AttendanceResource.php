<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduAttendance;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduAttendance::mapResource($request, $this);
    }
}
