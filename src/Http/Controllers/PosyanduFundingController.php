<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduFunding;
use Module\Posyandu\Models\Activity;
use Module\Posyandu\Http\Resources\FundingCollection;
use Module\Posyandu\Http\Resources\FundingShowResource;

class PosyanduFundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activity)
    {
        Gate::authorize('view', PosyanduFunding::class);

        return new FundingCollection(
            $activity
                ->fundings()
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
     * @param  \Module\Posyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        Gate::authorize('create', PosyanduFunding::class);

        $request->validate([]);

        return PosyanduFunding::storeRecord($request, $activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduFunding $posyanduFunding
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, PosyanduFunding $posyanduFunding)
    {
        Gate::authorize('show', $posyanduFunding);

        return new FundingShowResource($posyanduFunding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduFunding $posyanduFunding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity, PosyanduFunding $posyanduFunding)
    {
        Gate::authorize('update', $posyanduFunding);

        $request->validate([]);

        return PosyanduFunding::updateRecord($request, $posyanduFunding);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\Activity $activity
     * @param  \Module\Posyandu\Models\PosyanduFunding $posyanduFunding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, PosyanduFunding $posyanduFunding)
    {
        Gate::authorize('delete', $posyanduFunding);

        return PosyanduFunding::deleteRecord($posyanduFunding);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduFunding $posyanduFunding
     * @return \Illuminate\Http\Response
     */
    public function restore(Activity $activity, PosyanduFunding $posyanduFunding)
    {
        Gate::authorize('restore', $posyanduFunding);

        return PosyanduFunding::restoreRecord($posyanduFunding);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduFunding $posyanduFunding
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Activity $activity, PosyanduFunding $posyanduFunding)
    {
        Gate::authorize('destroy', $posyanduFunding);

        return PosyanduFunding::destroyRecord($posyanduFunding);
    }
}