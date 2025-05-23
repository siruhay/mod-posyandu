<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduSubmission;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubmissionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return SubmissionResource::collection($this->collection);
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
                'combos' => PosyanduSubmission::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduSubmission::mapFilters(),

                /** the table header */
                'headers' => PosyanduSubmission::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduSubmission::getPageIcon('posyandu-submission'),

                /** the record key */
                'key' => PosyanduSubmission::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduSubmission::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduSubmission::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduSubmission::getPageTitle($request, 'posyandu-submission'),

                /** the usetrash flag */
                'usetrash' => PosyanduSubmission::hasSoftDeleted(),
            ]
        ];
    }
}
