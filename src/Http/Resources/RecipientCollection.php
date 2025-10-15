<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduRecipient;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return RecipientResource::collection($this->collection);
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
                'combos' => PosyanduRecipient::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduRecipient::mapFilters(),

                /** the table header */
                'headers' => PosyanduRecipient::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduRecipient::getPageIcon('posyandu-recipient'),

                /** the record key */
                'key' => PosyanduRecipient::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduRecipient::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduRecipient::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduRecipient::getPageTitle($request, 'posyandu-recipient'),

                /** the usetrash flag */
                'usetrash' => PosyanduRecipient::hasSoftDeleted(),
            ]
        ];
    }
}
