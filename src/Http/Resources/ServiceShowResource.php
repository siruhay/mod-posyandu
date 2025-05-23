<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduService;
use Module\System\Http\Resources\UserLogActivity;

class ServiceShowResource extends JsonResource
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
            'record' => PosyanduService::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduService::mapCombos($request, $this),

                'icon' => PosyanduService::getPageIcon('posyandu-service'),

                'key' => PosyanduService::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduService::mapStatuses($request, $this),

                'title' => PosyanduService::getPageTitle($request, 'posyandu-service'),
            ],
        ];
    }
}
