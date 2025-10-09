<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduFunding;
use Module\System\Http\Resources\UserLogActivity;

class FundingShowResource extends JsonResource
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
            'record' => PosyanduFunding::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduFunding::mapCombos($request, $this),

                'icon' => PosyanduFunding::getPageIcon('posyandu-funding'),

                'key' => PosyanduFunding::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduFunding::mapStatuses($request, $this),

                'title' => PosyanduFunding::getPageTitle($request, 'posyandu-funding'),
            ],
        ];
    }
}
