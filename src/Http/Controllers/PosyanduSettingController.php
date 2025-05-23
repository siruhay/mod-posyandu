<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduSetting;
use Module\Posyandu\Http\Resources\SettingCollection;
use Module\Posyandu\Http\Resources\SettingShowResource;

class PosyanduSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduSetting::class);

        return new SettingCollection(
            PosyanduSetting::applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', PosyanduSetting::class);

        $request->validate([]);

        return PosyanduSetting::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduSetting $posyanduSetting
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduSetting $posyanduSetting)
    {
        Gate::authorize('show', $posyanduSetting);

        return new SettingShowResource($posyanduSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduSetting $posyanduSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduSetting $posyanduSetting)
    {
        Gate::authorize('update', $posyanduSetting);

        $request->validate([]);

        return PosyanduSetting::updateRecord($request, $posyanduSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduSetting $posyanduSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduSetting $posyanduSetting)
    {
        Gate::authorize('delete', $posyanduSetting);

        return PosyanduSetting::deleteRecord($posyanduSetting);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSetting $posyanduSetting
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduSetting $posyanduSetting)
    {
        Gate::authorize('restore', $posyanduSetting);

        return PosyanduSetting::restoreRecord($posyanduSetting);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSetting $posyanduSetting
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduSetting $posyanduSetting)
    {
        Gate::authorize('destroy', $posyanduSetting);

        return PosyanduSetting::destroyRecord($posyanduSetting);
    }
}
