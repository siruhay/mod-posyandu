<?php

namespace Module\Posyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\Posyandu\Models\PosyanduComplaint;
use Module\System\Http\Resources\UserLogActivity;

class ComplaintShowResource extends JsonResource
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
            'record' => PosyanduComplaint::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => PosyanduComplaint::mapCombos($request, $this),

                'icon' => PosyanduComplaint::getPageIcon('posyandu-complain'),

                'key' => PosyanduComplaint::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => PosyanduComplaint::mapStatuses($request, $this),

                'title' => PosyanduComplaint::getPageTitle($request, 'posyandu-complain'),
            ],
        ];
    }
}
