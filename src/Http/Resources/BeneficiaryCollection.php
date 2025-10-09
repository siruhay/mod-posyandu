<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduBeneficiary;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BeneficiaryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BeneficiaryResource::collection($this->collection);
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
                'combos' => PosyanduBeneficiary::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduBeneficiary::mapFilters(),

                /** the table header */
                'headers' => PosyanduBeneficiary::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduBeneficiary::getPageIcon('posyandu-beneficiary'),

                /** the record key */
                'key' => PosyanduBeneficiary::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduBeneficiary::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduBeneficiary::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduBeneficiary::getPageTitle($request, 'posyandu-beneficiary'),

                /** the usetrash flag */
                'usetrash' => PosyanduBeneficiary::hasSoftDeleted(),
            ]
        ];
    }
}
