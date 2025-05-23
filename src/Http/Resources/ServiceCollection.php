<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ServiceResource::collection($this->collection);
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
                'combos' => PosyanduService::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduService::mapFilters(),

                /** the table header */
                'headers' => PosyanduService::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduService::getPageIcon('posyandu-service'),

                /** the record key */
                'key' => PosyanduService::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduService::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduService::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduService::getPageTitle($request, 'posyandu-service'),

                /** the usetrash flag */
                'usetrash' => PosyanduService::hasSoftDeleted(),
            ]
        ];
    }
}
