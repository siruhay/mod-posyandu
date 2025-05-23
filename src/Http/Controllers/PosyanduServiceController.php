<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduService;
use Module\Posyandu\Http\Resources\ServiceCollection;
use Module\Posyandu\Http\Resources\ServiceShowResource;

class PosyanduServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduService::class);

        return new ServiceCollection(
            PosyanduService::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduService::class);

        $request->validate([]);

        return PosyanduService::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduService $posyanduService)
    {
        Gate::authorize('show', $posyanduService);

        return new ServiceShowResource($posyanduService);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduService $posyanduService)
    {
        Gate::authorize('update', $posyanduService);

        $request->validate([]);

        return PosyanduService::updateRecord($request, $posyanduService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduService $posyanduService)
    {
        Gate::authorize('delete', $posyanduService);

        return PosyanduService::deleteRecord($posyanduService);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduService $posyanduService)
    {
        Gate::authorize('restore', $posyanduService);

        return PosyanduService::restoreRecord($posyanduService);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduService $posyanduService)
    {
        Gate::authorize('destroy', $posyanduService);

        return PosyanduService::destroyRecord($posyanduService);
    }
}
