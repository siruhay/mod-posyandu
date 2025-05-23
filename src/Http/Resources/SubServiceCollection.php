<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduSubService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubServiceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return SubServiceResource::collection($this->collection);
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
                'combos' => PosyanduSubService::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduSubService::mapFilters(),

                /** the table header */
                'headers' => PosyanduSubService::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduSubService::getPageIcon('posyandu-subservice'),

                /** the record key */
                'key' => PosyanduSubService::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduSubService::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduSubService::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduSubService::getPageTitle($request, 'posyandu-subservice'),

                /** the usetrash flag */
                'usetrash' => PosyanduSubService::hasSoftDeleted(),
            ]
        ];
    }
}
