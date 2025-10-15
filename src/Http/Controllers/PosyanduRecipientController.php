<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduRecipient;
use Module\Posyandu\Models\PosyanduActivity;
use Module\Posyandu\Http\Resources\RecipientCollection;
use Module\Posyandu\Http\Resources\RecipientShowResource;

class PosyanduRecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PosyanduActivity $posyanduActivity)
    {
        Gate::authorize('view', PosyanduRecipient::class);

        return new RecipientCollection(
            $posyanduActivity
                ->recipients()
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
        Gate::authorize('create', PosyanduRecipient::class);

        $request->validate([]);

        return PosyanduRecipient::storeRecord($request, $posyanduActivity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduRecipient $posyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduActivity $posyanduActivity, PosyanduRecipient $posyanduRecipient)
    {
        Gate::authorize('show', $posyanduRecipient);

        return new RecipientShowResource($posyanduRecipient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduRecipient $posyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduActivity $posyanduActivity, PosyanduRecipient $posyanduRecipient)
    {
        Gate::authorize('update', $posyanduRecipient);

        $request->validate([]);

        return PosyanduRecipient::updateRecord($request, $posyanduRecipient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduActivity $posyanduActivity
     * @param  \Module\Posyandu\Models\PosyanduRecipient $posyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduActivity $posyanduActivity, PosyanduRecipient $posyanduRecipient)
    {
        Gate::authorize('delete', $posyanduRecipient);

        return PosyanduRecipient::deleteRecord($posyanduRecipient);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduRecipient $posyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduActivity $posyanduActivity, PosyanduRecipient $posyanduRecipient)
    {
        Gate::authorize('restore', $posyanduRecipient);

        return PosyanduRecipient::restoreRecord($posyanduRecipient);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduRecipient $posyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduActivity $posyanduActivity, PosyanduRecipient $posyanduRecipient)
    {
        Gate::authorize('destroy', $posyanduRecipient);

        return PosyanduRecipient::destroyRecord($posyanduRecipient);
    }
}