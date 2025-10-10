<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduAttendance;
use Module\System\Http\Resources\UserLogActivity;

class AttendanceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            /**
             * the record data
             */
            'record' => PosyanduAttendance::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduAttendance::mapCombos($request, $this),

                'icon' => PosyanduAttendance::getPageIcon('posyandu-attendance'),

                'key' => PosyanduAttendance::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduAttendance::mapStatuses($request, $this),

                'title' => PosyanduAttendance::getPageTitle($request, 'posyandu-attendance'),
            ],
        ];
    }
}
