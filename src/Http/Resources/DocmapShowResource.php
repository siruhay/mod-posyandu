<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduDocmap;
use Module\System\Http\Resources\UserLogActivity;

class DocmapShowResource extends JsonResource
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
            'record' => PosyanduDocmap::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduDocmap::mapCombos($request, $this),

                'icon' => PosyanduDocmap::getPageIcon('posyandu-docmap'),

                'key' => PosyanduDocmap::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduDocmap::mapStatuses($request, $this),

                'title' => PosyanduDocmap::getPageTitle($request, 'posyandu-docmap'),
            ],
        ];
    }
}
