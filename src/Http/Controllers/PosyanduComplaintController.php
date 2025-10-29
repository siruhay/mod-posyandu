<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduComplaint;
use Module\Posyandu\Http\Resources\ComplaintCollection;
use Module\Posyandu\Http\Resources\ComplaintShowResource;

class PosyanduComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduComplaint::class);

        return new ComplaintCollection(
            PosyanduComplaint::with(['community', 'community.village', 'service'])
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
        Gate::authorize('create', PosyanduComplaint::class);

        $request->validate([]);

        return PosyanduComplaint::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduComplaint $posyanduComplaint)
    {
        Gate::authorize('show', $posyanduComplaint);

        return new ComplaintShowResource($posyanduComplaint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduComplaint $posyanduComplaint)
    {
        Gate::authorize('update', $posyanduComplaint);

        $request->validate([]);

        return PosyanduComplaint::updateRecord($request, $posyanduComplaint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduComplaint $posyanduComplaint)
    {
        Gate::authorize('delete', $posyanduComplaint);

        return PosyanduComplaint::deleteRecord($posyanduComplaint);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduComplaint $posyanduComplaint)
    {
        Gate::authorize('restore', $posyanduComplaint);

        return PosyanduComplaint::restoreRecord($posyanduComplaint);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduComplaint $posyanduComplaint)
    {
        Gate::authorize('destroy', $posyanduComplaint);

        return PosyanduComplaint::destroyRecord($posyanduComplaint);
    }
}
