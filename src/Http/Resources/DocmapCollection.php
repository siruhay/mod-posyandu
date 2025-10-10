<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduDocmap;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DocmapCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return DocmapResource::collection($this->collection);
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
                'combos' => PosyanduDocmap::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduDocmap::mapFilters(),

                /** the table header */
                'headers' => PosyanduDocmap::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduDocmap::getPageIcon('posyandu-docmap'),

                /** the record key */
                'key' => PosyanduDocmap::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduDocmap::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduDocmap::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduDocmap::getPageTitle($request, 'posyandu-docmap'),

                /** the usetrash flag */
                'usetrash' => PosyanduDocmap::hasSoftDeleted(),
            ]
        ];
    }
}
