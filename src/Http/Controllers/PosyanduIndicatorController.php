<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduIndicator;
use Module\Posyandu\Http\Resources\IndicatorCollection;
use Module\Posyandu\Http\Resources\IndicatorShowResource;

class PosyanduIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduIndicator::class);

        return new IndicatorCollection(
            PosyanduIndicator::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduIndicator::class);

        $request->validate([]);

        return PosyanduIndicator::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduIndicator $posyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduIndicator $posyanduIndicator)
    {
        Gate::authorize('show', $posyanduIndicator);

        return new IndicatorShowResource($posyanduIndicator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduIndicator $posyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduIndicator $posyanduIndicator)
    {
        Gate::authorize('update', $posyanduIndicator);

        $request->validate([]);

        return PosyanduIndicator::updateRecord($request, $posyanduIndicator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduIndicator $posyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduIndicator $posyanduIndicator)
    {
        Gate::authorize('delete', $posyanduIndicator);

        return PosyanduIndicator::deleteRecord($posyanduIndicator);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduIndicator $posyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduIndicator $posyanduIndicator)
    {
        Gate::authorize('restore', $posyanduIndicator);

        return PosyanduIndicator::restoreRecord($posyanduIndicator);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduIndicator $posyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduIndicator $posyanduIndicator)
    {
        Gate::authorize('destroy', $posyanduIndicator);

        return PosyanduIndicator::destroyRecord($posyanduIndicator);
    }
}
