<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduReport;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ReportResource::collection($this->collection);
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
                'combos' => PosyanduReport::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduReport::mapFilters(),

                /** the table header */
                'headers' => PosyanduReport::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduReport::getPageIcon('posyandu-report'),

                /** the record key */
                'key' => PosyanduReport::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduReport::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduReport::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduReport::getPageTitle($request, 'posyandu-report'),

                /** the usetrash flag */
                'usetrash' => PosyanduReport::hasSoftDeleted(),
            ]
        ];
    }
}
