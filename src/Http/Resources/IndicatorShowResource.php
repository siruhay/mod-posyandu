<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduIndicator;
use Module\System\Http\Resources\UserLogActivity;

class IndicatorShowResource extends JsonResource
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
            'record' => PosyanduIndicator::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduIndicator::mapCombos($request, $this),

                'icon' => PosyanduIndicator::getPageIcon('posyandu-indicator'),

                'key' => PosyanduIndicator::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduIndicator::mapStatuses($request, $this),

                'title' => PosyanduIndicator::getPageTitle($request, 'posyandu-indicator'),
            ],
        ];
    }
}
