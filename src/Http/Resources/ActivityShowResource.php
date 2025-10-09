<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduActivity;
use Module\System\Http\Resources\UserLogActivity;

class ActivityShowResource extends JsonResource
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
            'record' => PosyanduActivity::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduActivity::mapCombos($request, $this),

                'icon' => PosyanduActivity::getPageIcon('posyandu-activity'),

                'key' => PosyanduActivity::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduActivity::mapStatuses($request, $this),

                'title' => PosyanduActivity::getPageTitle($request, 'posyandu-activity'),
            ],
        ];
    }
}
