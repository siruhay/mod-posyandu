<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduComplaint;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComplaintCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ComplaintResource::collection($this->collection);
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
                'combos' => PosyanduComplaint::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduComplaint::mapFilters(),

                /** the table header */
                'headers' => PosyanduComplaint::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduComplaint::getPageIcon('posyandu-complain'),

                /** the record key */
                'key' => PosyanduComplaint::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduComplaint::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduComplaint::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduComplaint::getPageTitle($request, 'posyandu-complain'),

                /** the usetrash flag */
                'usetrash' => PosyanduComplaint::hasSoftDeleted(),
            ]
        ];
    }
}
