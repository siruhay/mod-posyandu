<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduDocument;
use Module\Posyandu\Http\Resources\DocumentCollection;
use Module\Posyandu\Http\Resources\DocumentShowResource;

class PosyanduDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduDocument::class);

        return new DocumentCollection(
            PosyanduDocument::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduDocument::class);

        $request->validate([]);

        return PosyanduDocument::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocument $posyanduDocument
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduDocument $posyanduDocument)
    {
        Gate::authorize('show', $posyanduDocument);

        return new DocumentShowResource($posyanduDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduDocument $posyanduDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduDocument $posyanduDocument)
    {
        Gate::authorize('update', $posyanduDocument);

        $request->validate([]);

        return PosyanduDocument::updateRecord($request, $posyanduDocument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocument $posyanduDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduDocument $posyanduDocument)
    {
        Gate::authorize('delete', $posyanduDocument);

        return PosyanduDocument::deleteRecord($posyanduDocument);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocument $posyanduDocument
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduDocument $posyanduDocument)
    {
        Gate::authorize('restore', $posyanduDocument);

        return PosyanduDocument::restoreRecord($posyanduDocument);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduDocument $posyanduDocument
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduDocument $posyanduDocument)
    {
        Gate::authorize('destroy', $posyanduDocument);

        return PosyanduDocument::destroyRecord($posyanduDocument);
    }
}
