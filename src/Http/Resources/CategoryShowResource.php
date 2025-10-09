<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduCategory;
use Module\System\Http\Resources\UserLogActivity;

class CategoryShowResource extends JsonResource
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
            'record' => PosyanduCategory::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduCategory::mapCombos($request, $this),

                'icon' => PosyanduCategory::getPageIcon('posyandu-category'),

                'key' => PosyanduCategory::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduCategory::mapStatuses($request, $this),

                'title' => PosyanduCategory::getPageTitle($request, 'posyandu-category'),
            ],
        ];
    }
}
