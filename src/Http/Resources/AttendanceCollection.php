<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduAttendance;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AttendanceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return AttendanceResource::collection($this->collection);
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
                'combos' => PosyanduAttendance::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduAttendance::mapFilters(),

                /** the table header */
                'headers' => PosyanduAttendance::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduAttendance::getPageIcon('posyandu-attendance'),

                /** the record key */
                'key' => PosyanduAttendance::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduAttendance::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduAttendance::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduAttendance::getPageTitle($request, 'posyandu-attendance'),

                /** the usetrash flag */
                'usetrash' => PosyanduAttendance::hasSoftDeleted(),
            ]
        ];
    }
}
