<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduPremise;
use Module\Posyandu\Models\PosyanduActivity;
use Module\Posyandu\Http\Resources\PremiseCollection;
use Module\Posyandu\Http\Resources\PremiseShowResource;

class PosyanduPremiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('view', PosyanduPremise::class);

        return new PremiseCollection(
            $posyanduActivity
                ->premises()
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
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('create', PosyanduPremise::class);

        $request->validate([]);

        return PosyanduPremise::storeRecord($request, $posyanduActivity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduPremise $posyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduActivity $posyanduActivity, PosyanduPremise $posyanduPremise)
    {
        Gate::authorize('show', $posyanduPremise);

        return new PremiseShowResource($posyanduPremise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduPremise $posyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduActivity $posyanduActivity, PosyanduPremise $posyanduPremise)
    {
        Gate::authorize('update', $posyanduPremise);

        $request->validate([]);

        return PosyanduPremise::updateRecord($request, $posyanduPremise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduPremise $posyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduActivity $posyanduActivity, PosyanduPremise $posyanduPremise)
    {
        Gate::authorize('delete', $posyanduPremise);

        return PosyanduPremise::deleteRecord($posyanduPremise);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduPremise $posyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduActivity $posyanduActivity, PosyanduPremise $posyanduPremise)
    {
        Gate::authorize('restore', $posyanduPremise);

        return PosyanduPremise::restoreRecord($posyanduPremise);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduPremise $posyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduActivity $posyanduActivity, PosyanduPremise $posyanduPremise)
    {
        Gate::authorize('destroy', $posyanduPremise);

        return PosyanduPremise::destroyRecord($posyanduPremise);
    }
}