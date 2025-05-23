<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduSetting;
use Module\System\Http\Resources\UserLogActivity;

class SettingShowResource extends JsonResource
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
            'record' => PosyanduSetting::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduSetting::mapCombos($request, $this),

                'icon' => PosyanduSetting::getPageIcon('posyandu-setting'),

                'key' => PosyanduSetting::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduSetting::mapStatuses($request, $this),

                'title' => PosyanduSetting::getPageTitle($request, 'posyandu-setting'),
            ],
        ];
    }
}
