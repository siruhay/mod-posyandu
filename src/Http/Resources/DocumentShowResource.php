<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduDocument;
use Module\System\Http\Resources\UserLogActivity;

class DocumentShowResource extends JsonResource
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
            'record' => PosyanduDocument::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduDocument::mapCombos($request, $this),

                'icon' => PosyanduDocument::getPageIcon('posyandu-document'),

                'key' => PosyanduDocument::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduDocument::mapStatuses($request, $this),

                'title' => PosyanduDocument::getPageTitle($request, 'posyandu-document'),
            ],
        ];
    }
}
