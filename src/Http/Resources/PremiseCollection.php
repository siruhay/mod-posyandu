<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduPremise;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PremiseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PremiseResource::collection($this->collection);
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
                'combos' => PosyanduPremise::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduPremise::mapFilters(),

                /** the table header */
                'headers' => PosyanduPremise::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduPremise::getPageIcon('posyandu-premise'),

                /** the record key */
                'key' => PosyanduPremise::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduPremise::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduPremise::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduPremise::getPageTitle($request, 'posyandu-premise'),

                /** the usetrash flag */
                'usetrash' => PosyanduPremise::hasSoftDeleted(),
            ]
        ];
    }
}
