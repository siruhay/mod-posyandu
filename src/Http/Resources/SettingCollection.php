<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduSetting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return SettingResource::collection($this->collection);
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
                'combos' => PosyanduSetting::mapCombos($request),

                /** the page data filter */
                'filters' => PosyanduSetting::mapFilters(),

                /** the table header */
                'headers' => PosyanduSetting::mapHeaders($request),

                /** the page icon */
                'icon' => PosyanduSetting::getPageIcon('posyandu-setting'),

                /** the record key */
                'key' => PosyanduSetting::getDataKey(),

                /** the page default */
                'recordBase' => PosyanduSetting::mapRecordBase($request),

                /** the page statuses */
                'statuses' => PosyanduSetting::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => PosyanduSetting::getPageTitle($request, 'posyandu-setting'),

                /** the usetrash flag */
                'usetrash' => PosyanduSetting::hasSoftDeleted(),
            ]
        ];
    }
}
