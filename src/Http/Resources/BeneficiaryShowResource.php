<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduBeneficiary;
use Module\System\Http\Resources\UserLogActivity;

class BeneficiaryShowResource extends JsonResource
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
            'record' => PosyanduBeneficiary::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduBeneficiary::mapCombos($request, $this),

                'icon' => PosyanduBeneficiary::getPageIcon('posyandu-beneficiary'),

                'key' => PosyanduBeneficiary::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduBeneficiary::mapStatuses($request, $this),

                'title' => PosyanduBeneficiary::getPageTitle($request, 'posyandu-beneficiary'),
            ],
        ];
    }
}
