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
            PosyanduComplaint::applyMode($request->mode)
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
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduComplaint $posyanduComplain)
    {
        Gate::authorize('show', $posyanduComplain);

        return new ComplaintShowResource($posyanduComplain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduComplaint $posyanduComplain)
    {
        Gate::authorize('update', $posyanduComplain);

        $request->validate([]);

        return PosyanduComplaint::updateRecord($request, $posyanduComplain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduComplaint $posyanduComplain)
    {
        Gate::authorize('delete', $posyanduComplain);

        return PosyanduComplaint::deleteRecord($posyanduComplain);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduComplaint $posyanduComplain)
    {
        Gate::authorize('restore', $posyanduComplain);

        return PosyanduComplaint::restoreRecord($posyanduComplain);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplaint $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduComplaint $posyanduComplain)
    {
        Gate::authorize('destroy', $posyanduComplain);

        return PosyanduComplaint::destroyRecord($posyanduComplain);
    }
}
