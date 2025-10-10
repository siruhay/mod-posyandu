<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduDocument;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return DocumentResource::collection($this->collection);
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
                'combos' => PosyanduDocument::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduDocument::mapFilters(),

                /** the table header */
                'headers' => PosyanduDocument::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduDocument::getPageIcon('posyandu-document'),

                /** the record key */
                'key' => PosyanduDocument::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduDocument::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduDocument::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduDocument::getPageTitle($request, 'posyandu-document'),

                /** the usetrash flag */
                'usetrash' => PosyanduDocument::hasSoftDeleted(),
            ]
        ];
    }
}
