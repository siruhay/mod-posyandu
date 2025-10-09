<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduFunding;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FundingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return FundingResource::collection($this->collection);
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
                'combos' => PosyanduFunding::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduFunding::mapFilters(),

                /** the table header */
                'headers' => PosyanduFunding::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduFunding::getPageIcon('posyandu-funding'),

                /** the record key */
                'key' => PosyanduFunding::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduFunding::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduFunding::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduFunding::getPageTitle($request, 'posyandu-funding'),

                /** the usetrash flag */
                'usetrash' => PosyanduFunding::hasSoftDeleted(),
            ]
        ];
    }
}
