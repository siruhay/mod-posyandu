<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return CategoryResource::collection($this->collection);
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
                'combos' => PosyanduCategory::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduCategory::mapFilters(),

                /** the table header */
                'headers' => PosyanduCategory::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduCategory::getPageIcon('posyandu-category'),

                /** the record key */
                'key' => PosyanduCategory::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduCategory::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduCategory::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduCategory::getPageTitle($request, 'posyandu-category'),

                /** the usetrash flag */
                'usetrash' => PosyanduCategory::hasSoftDeleted(),
            ]
        ];
    }
}
