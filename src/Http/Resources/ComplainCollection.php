<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduComplain;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComplainCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ComplainResource::collection($this->collection);
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
                'combos' => PosyanduComplain::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduComplain::mapFilters(),

                /** the table header */
                'headers' => PosyanduComplain::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduComplain::getPageIcon('posyandu-complain'),

                /** the record key */
                'key' => PosyanduComplain::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduComplain::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduComplain::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduComplain::getPageTitle($request, 'posyandu-complain'),

                /** the usetrash flag */
                'usetrash' => PosyanduComplain::hasSoftDeleted(),
            ]
        ];
    }
}
