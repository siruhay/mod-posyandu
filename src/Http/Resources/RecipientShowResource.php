<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduRecipient;
use Module\System\Http\Resources\UserLogActivity;

class RecipientShowResource extends JsonResource
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
            'record' => PosyanduRecipient::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduRecipient::mapCombos($request, $this),

                'icon' => PosyanduRecipient::getPageIcon('posyandu-recipient'),

                'key' => PosyanduRecipient::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduRecipient::mapStatuses($request, $this),

                'title' => PosyanduRecipient::getPageTitle($request, 'posyandu-recipient'),
            ],
        ];
    }
}
