<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduPremise;
use Module\System\Http\Resources\UserLogActivity;

class PremiseShowResource extends JsonResource
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
            'record' => PosyanduPremise::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduPremise::mapCombos($request, $this),

                'icon' => PosyanduPremise::getPageIcon('posyandu-premise'),

                'key' => PosyanduPremise::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduPremise::mapStatuses($request, $this),

                'title' => PosyanduPremise::getPageTitle($request, 'posyandu-premise'),
            ],
        ];
    }
}
