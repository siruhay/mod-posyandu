<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduActivity;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ActivityResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        if ($request->has('initialized')) {
            return [];
        }

        return [
            'setups' => [
                /** the page combo */
                'combos' => PosyanduActivity::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduActivity::mapFilters(),

                /** the table header */
                'headers' => PosyanduActivity::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduActivity::getPageIcon('posyandu-activity'),

                /** the record key */
                'key' => PosyanduActivity::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduActivity::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduActivity::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduActivity::getPageTitle($request, 'posyandu-activity'),

                /** the usetrash flag */
                'usetrash' => PosyanduActivity::hasSoftDeleted(),
            ]
        ];
    }
}
