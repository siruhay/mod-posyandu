<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduIndicator;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicatorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return IndicatorResource::collection($this->collection);
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
                'combos' => PosyanduIndicator::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduIndicator::mapFilters(),

                /** the table header */
                'headers' => PosyanduIndicator::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduIndicator::getPageIcon('posyandu-indicator'),

                /** the record key */
                'key' => PosyanduIndicator::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduIndicator::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduIndicator::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduIndicator::getPageTitle($request, 'posyandu-indicator'),

                /** the usetrash flag */
                'usetrash' => PosyanduIndicator::hasSoftDeleted(),
            ]
        ];
    }
}
