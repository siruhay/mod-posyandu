<?php

namespace Module\Posyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\Posyandu\Models\PosyanduCategory;
use Module\Posyandu\Http\Resources\CategoryCollection;
use Module\Posyandu\Http\Resources\CategoryShowResource;

class PosyanduCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', PosyanduCategory::class);

        return new CategoryCollection(
            PosyanduCategory::applyMode($request->mode)
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
        Gate::authorize('create', PosyanduCategory::class);

        $request->validate([]);

        return PosyanduCategory::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\Posyandu\Models\PosyanduCategory $posyanduCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PosyanduCategory $posyanduCategory)
    {
        Gate::authorize('show', $posyanduCategory);

        return new CategoryShowResource($posyanduCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\Posyandu\Models\PosyanduCategory $posyanduCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosyanduCategory $posyanduCategory)
    {
        Gate::authorize('update', $posyanduCategory);

        $request->validate([]);

        return PosyanduCategory::updateRecord($request, $posyanduCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\Posyandu\Models\PosyanduCategory $posyanduCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosyanduCategory $posyanduCategory)
    {
        Gate::authorize('delete', $posyanduCategory);

        return PosyanduCategory::deleteRecord($posyanduCategory);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduCategory $posyanduCategory
     * @return \Illuminate\Http\Response
     */
    public function restore(PosyanduCategory $posyanduCategory)
    {
        Gate::authorize('restore', $posyanduCategory);

        return PosyanduCategory::restoreRecord($posyanduCategory);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\Posyandu\Models\PosyanduCategory $posyanduCategory
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(PosyanduCategory $posyanduCategory)
    {
        Gate::authorize('destroy', $posyanduCategory);

        return PosyanduCategory::destroyRecord($posyanduCategory);
    }
}
