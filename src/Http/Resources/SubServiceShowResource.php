<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduSubService;
use Module\System\Http\Resources\UserLogActivity;

class SubServiceShowResource extends JsonResource
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
            'record' => PosyanduSubService::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduSubService::mapCombos($request, $this),

                'icon' => PosyanduSubService::getPageIcon('posyandu-subservice'),

                'key' => PosyanduSubService::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduSubService::mapStatuses($request, $this),

                'title' => PosyanduSubService::getPageTitle($request, 'posyandu-subservice'),
            ],
        ];
    }
}
