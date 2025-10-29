<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduActivity;
use Module\Posyandu\Http\Resources\ActivityCollection;
use Module\Posyandu\Http\Resources\ActivityShowResource;

class PosyanduActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduActivity::class);

        return new ActivityCollection(
            PosyanduActivity::with(['community', 'community.village', 'service'])
                ->forCurrentUser($request->user())
                ->applyMode($request->mode)
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
        Gate::authorize('create', PosyanduActivity::class);

        $request->validate([]);

        return PosyanduActivity::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('show', $posyanduActivity);

        return new ActivityShowResource($posyanduActivity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('update', $posyanduActivity);

        $request->validate([]);

        return PosyanduActivity::updateRecord($request, $posyanduActivity);
    }

    /**
     * determinated function
     *
     * @param Request $request
     * @param PosyanduActivity $posyanduActivity
     * @return void
     */
    public function determinated(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('update', $posyanduActivity);

        $request->validate([]);

        return PosyanduActivity::determinateRecord($request, $posyanduActivity);
    }

    /**
     * rejected function
     *
     * @param Request $request
     * @param PosyanduActivity $posyanduActivity
     * @return void
     */
    public function rejected(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('update', $posyanduActivity);

        $request->validate([]);

        return PosyanduActivity::rejectRecord($request, $posyanduActivity);
    }

    /**
     * submitted function
     *
     * @param Request $request
     * @param PosyanduActivity $posyanduActivity
     * @return void
     */
    public function submitted(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('update', $posyanduActivity);

        $request->validate([]);

        return PosyanduActivity::submitRecord($request, $posyanduActivity);
    }

    /**
     * verified function
     *
     * @param Request $request
     * @param PosyanduActivity $posyanduActivity
     * @return void
     */
    public function verified(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('update', $posyanduActivity);

        $request->validate([]);

        return PosyanduActivity::verifyRecord($request, $posyanduActivity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('delete', $posyanduActivity);

        return PosyanduActivity::deleteRecord($posyanduActivity);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('restore', $posyanduActivity);

        return PosyanduActivity::restoreRecord($posyanduActivity);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('destroy', $posyanduActivity);

        return PosyanduActivity::destroyRecord($posyanduActivity);
    }
}
