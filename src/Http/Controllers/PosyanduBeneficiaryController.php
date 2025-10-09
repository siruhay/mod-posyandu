<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduBeneficiary;
use Module\Posyandu\Http\Resources\BeneficiaryCollection;
use Module\Posyandu\Http\Resources\BeneficiaryShowResource;

class PosyanduBeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduBeneficiary::class);

        return new BeneficiaryCollection(
            PosyanduBeneficiary::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduBeneficiary::class);

        $request->validate([]);

        return PosyanduBeneficiary::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduBeneficiary $posyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduBeneficiary $posyanduBeneficiary)
    {
        Gate::authorize('show', $posyanduBeneficiary);

        return new BeneficiaryShowResource($posyanduBeneficiary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduBeneficiary $posyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduBeneficiary $posyanduBeneficiary)
    {
        Gate::authorize('update', $posyanduBeneficiary);

        $request->validate([]);

        return PosyanduBeneficiary::updateRecord($request, $posyanduBeneficiary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduBeneficiary $posyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduBeneficiary $posyanduBeneficiary)
    {
        Gate::authorize('delete', $posyanduBeneficiary);

        return PosyanduBeneficiary::deleteRecord($posyanduBeneficiary);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduBeneficiary $posyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduBeneficiary $posyanduBeneficiary)
    {
        Gate::authorize('restore', $posyanduBeneficiary);

        return PosyanduBeneficiary::restoreRecord($posyanduBeneficiary);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduBeneficiary $posyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduBeneficiary $posyanduBeneficiary)
    {
        Gate::authorize('destroy', $posyanduBeneficiary);

        return PosyanduBeneficiary::destroyRecord($posyanduBeneficiary);
    }
}
