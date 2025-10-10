<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduAttendance;
use Module\Posyandu\Models\Activity;
use Module\Posyandu\Http\Resources\AttendanceCollection;
use Module\Posyandu\Http\Resources\AttendanceShowResource;

class PosyanduAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activity)
    {
        Gate::authorize('view', PosyanduAttendance::class);

        return new AttendanceCollection(
            $activity
                ->attendances()
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
        Gate::authorize('create', PosyanduAttendance::class);

        $request->validate([]);

        return PosyanduAttendance::storeRecord($request, $activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduAttendance $posyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, PosyanduAttendance $posyanduAttendance)
    {
        Gate::authorize('show', $posyanduAttendance);

        return new AttendanceShowResource($posyanduAttendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduAttendance $posyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity, PosyanduAttendance $posyanduAttendance)
    {
        Gate::authorize('update', $posyanduAttendance);

        $request->validate([]);

        return PosyanduAttendance::updateRecord($request, $posyanduAttendance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduAttendance $posyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, PosyanduAttendance $posyanduAttendance)
    {
        Gate::authorize('delete', $posyanduAttendance);

        return PosyanduAttendance::deleteRecord($posyanduAttendance);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduAttendance $posyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function restore(Activity $activity, PosyanduAttendance $posyanduAttendance)
    {
        Gate::authorize('restore', $posyanduAttendance);

        return PosyanduAttendance::restoreRecord($posyanduAttendance);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduAttendance $posyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Activity $activity, PosyanduAttendance $posyanduAttendance)
    {
        Gate::authorize('destroy', $posyanduAttendance);

        return PosyanduAttendance::destroyRecord($posyanduAttendance);
    }
}