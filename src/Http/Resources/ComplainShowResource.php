<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduComplain;
use Module\System\Http\Resources\UserLogActivity;

class ComplainShowResource extends JsonResource
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
            'record' => PosyanduComplain::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduComplain::mapCombos($request, $this),

                'icon' => PosyanduComplain::getPageIcon('posyandu-complain'),

                'key' => PosyanduComplain::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduComplain::mapStatuses($request, $this),

                'title' => PosyanduComplain::getPageTitle($request, 'posyandu-complain'),
            ],
        ];
    }
}
