<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduSubService;
use Module\Posyandu\Models\PosyanduService;
use Module\Posyandu\Http\Resources\SubServiceCollection;
use Module\Posyandu\Http\Resources\SubServiceShowResource;

class PosyanduSubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PosyanduService $posyanduService)
    {
        Gate::authorize('view', PosyanduSubService::class);

        return new SubServiceCollection(
            $posyanduService
                ->subservices()
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
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PosyanduService $posyanduService)
    {
        Gate::authorize('create', PosyanduSubService::class);

        $request->validate([]);

        return PosyanduSubService::storeRecord($request, $posyanduService);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @param  \Module\Posyandu\Models\PosyanduSubService $posyanduSubService
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduService $posyanduService, PosyanduSubService $posyanduSubService)
    {
        Gate::authorize('show', $posyanduSubService);

        return new SubServiceShowResource($posyanduSubService);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @param  \Module\Posyandu\Models\PosyanduSubService $posyanduSubService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduService $posyanduService, PosyanduSubService $posyanduSubService)
    {
        Gate::authorize('update', $posyanduSubService);

        $request->validate([]);

        return PosyanduSubService::updateRecord($request, $posyanduSubService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduService $posyanduService
     * @param  \Module\Posyandu\Models\PosyanduSubService $posyanduSubService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduService $posyanduService, PosyanduSubService $posyanduSubService)
    {
        Gate::authorize('delete', $posyanduSubService);

        return PosyanduSubService::deleteRecord($posyanduSubService);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubService $posyanduSubService
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduService $posyanduService, PosyanduSubService $posyanduSubService)
    {
        Gate::authorize('restore', $posyanduSubService);

        return PosyanduSubService::restoreRecord($posyanduSubService);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubService $posyanduSubService
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduService $posyanduService, PosyanduSubService $posyanduSubService)
    {
        Gate::authorize('destroy', $posyanduSubService);

        return PosyanduSubService::destroyRecord($posyanduSubService);
    }
}