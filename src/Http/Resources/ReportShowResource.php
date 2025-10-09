<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduReport;
use Module\System\Http\Resources\UserLogActivity;

class ReportShowResource extends JsonResource
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
            'record' => PosyanduReport::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduReport::mapCombos($request, $this),

                'icon' => PosyanduReport::getPageIcon('posyandu-report'),

                'key' => PosyanduReport::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduReport::mapStatuses($request, $this),

                'title' => PosyanduReport::getPageTitle($request, 'posyandu-report'),
            ],
        ];
    }
}
