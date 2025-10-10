<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduDocmap;
use Module\Posyandu\Http\Resources\DocmapCollection;
use Module\Posyandu\Http\Resources\DocmapShowResource;

class PosyanduDocmapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduDocmap::class);

        return new DocmapCollection(
            PosyanduDocmap::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduDocmap::class);

        $request->validate([]);

        return PosyanduDocmap::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocmap $posyanduDocmap
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduDocmap $posyanduDocmap)
    {
        Gate::authorize('show', $posyanduDocmap);

        return new DocmapShowResource($posyanduDocmap);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduDocmap $posyanduDocmap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduDocmap $posyanduDocmap)
    {
        Gate::authorize('update', $posyanduDocmap);

        $request->validate([]);

        return PosyanduDocmap::updateRecord($request, $posyanduDocmap);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocmap $posyanduDocmap
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduDocmap $posyanduDocmap)
    {
        Gate::authorize('delete', $posyanduDocmap);

        return PosyanduDocmap::deleteRecord($posyanduDocmap);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocmap $posyanduDocmap
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduDocmap $posyanduDocmap)
    {
        Gate::authorize('restore', $posyanduDocmap);

        return PosyanduDocmap::restoreRecord($posyanduDocmap);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocmap $posyanduDocmap
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduDocmap $posyanduDocmap)
    {
        Gate::authorize('destroy', $posyanduDocmap);

        return PosyanduDocmap::destroyRecord($posyanduDocmap);
    }
}
