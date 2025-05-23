<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduSubmission;
use Module\Posyandu\Http\Resources\SubmissionCollection;
use Module\Posyandu\Http\Resources\SubmissionShowResource;

class PosyanduSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduSubmission::class);

        return new SubmissionCollection(
            PosyanduSubmission::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduSubmission::class);

        $request->validate([]);

        return PosyanduSubmission::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubmission $posyanduSubmission
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduSubmission $posyanduSubmission)
    {
        Gate::authorize('show', $posyanduSubmission);

        return new SubmissionShowResource($posyanduSubmission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduSubmission $posyanduSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduSubmission $posyanduSubmission)
    {
        Gate::authorize('update', $posyanduSubmission);

        $request->validate([]);

        return PosyanduSubmission::updateRecord($request, $posyanduSubmission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubmission $posyanduSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduSubmission $posyanduSubmission)
    {
        Gate::authorize('delete', $posyanduSubmission);

        return PosyanduSubmission::deleteRecord($posyanduSubmission);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubmission $posyanduSubmission
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduSubmission $posyanduSubmission)
    {
        Gate::authorize('restore', $posyanduSubmission);

        return PosyanduSubmission::restoreRecord($posyanduSubmission);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduSubmission $posyanduSubmission
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduSubmission $posyanduSubmission)
    {
        Gate::authorize('destroy', $posyanduSubmission);

        return PosyanduSubmission::destroyRecord($posyanduSubmission);
    }
}
