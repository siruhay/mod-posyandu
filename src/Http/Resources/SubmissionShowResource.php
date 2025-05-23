<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduSubmission;
use Module\System\Http\Resources\UserLogActivity;

class SubmissionShowResource extends JsonResource
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
            'record' => PosyanduSubmission::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduSubmission::mapCombos($request, $this),

                'icon' => PosyanduSubmission::getPageIcon('posyandu-submission'),

                'key' => PosyanduSubmission::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduSubmission::mapStatuses($request, $this),

                'title' => PosyanduSubmission::getPageTitle($request, 'posyandu-submission'),
            ],
        ];
    }
}
