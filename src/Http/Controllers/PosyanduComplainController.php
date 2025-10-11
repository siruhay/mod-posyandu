<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduComplain;
use Module\Posyandu\Http\Resources\ComplainCollection;
use Module\Posyandu\Http\Resources\ComplainShowResource;

class PosyanduComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduComplain::class);

        return new ComplainCollection(
            PosyanduComplain::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduComplain::class);

        $request->validate([]);

        return PosyanduComplain::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplain $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduComplain $posyanduComplain)
    {
        Gate::authorize('show', $posyanduComplain);

        return new ComplainShowResource($posyanduComplain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduComplain $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduComplain $posyanduComplain)
    {
        Gate::authorize('update', $posyanduComplain);

        $request->validate([]);

        return PosyanduComplain::updateRecord($request, $posyanduComplain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplain $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduComplain $posyanduComplain)
    {
        Gate::authorize('delete', $posyanduComplain);

        return PosyanduComplain::deleteRecord($posyanduComplain);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplain $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduComplain $posyanduComplain)
    {
        Gate::authorize('restore', $posyanduComplain);

        return PosyanduComplain::restoreRecord($posyanduComplain);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduComplain $posyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduComplain $posyanduComplain)
    {
        Gate::authorize('destroy', $posyanduComplain);

        return PosyanduComplain::destroyRecord($posyanduComplain);
    }
}
