<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduReport;
use Module\Posyandu\Models\Activity;
use Module\Posyandu\Http\Resources\ReportCollection;
use Module\Posyandu\Http\Resources\ReportShowResource;

class PosyanduReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activity)
    {
        Gate::authorize('view', PosyanduReport::class);

        return new ReportCollection(
            $activity
                ->reports()
                ->applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy, $request->sortDesc)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        Gate::authorize('create', PosyanduReport::class);

        $request->validate([]);

        return PosyanduReport::storeRecord($request, $activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduReport $posyanduReport
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, PosyanduReport $posyanduReport)
    {
        Gate::authorize('show', $posyanduReport);

        return new ReportShowResource($posyanduReport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduReport $posyanduReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity, PosyanduReport $posyanduReport)
    {
        Gate::authorize('update', $posyanduReport);

        $request->validate([]);

        return PosyanduReport::updateRecord($request, $posyanduReport);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduReport $posyanduReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, PosyanduReport $posyanduReport)
    {
        Gate::authorize('delete', $posyanduReport);

        return PosyanduReport::deleteRecord($posyanduReport);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduReport $posyanduReport
     * @return \Illuminate\Http\Response
     */
    public function restore(Activity $activity, PosyanduReport $posyanduReport)
    {
        Gate::authorize('restore', $posyanduReport);

        return PosyanduReport::restoreRecord($posyanduReport);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduReport $posyanduReport
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Activity $activity, PosyanduReport $posyanduReport)
    {
        Gate::authorize('destroy', $posyanduReport);

        return PosyanduReport::destroyRecord($posyanduReport);
    }
}