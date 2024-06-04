<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlergenRequest;
use App\Http\Requests\UpdateAlergenRequest;
use App\Http\Resources\AlergenResource;
use App\Http\Resources\AlergenTreeResource;
use App\Models\Alergen;
use Illuminate\Http\Request;

class AlergenController extends Controller
{
    public function index()
    {
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $alergens = Alergen::query()
            ->orderBy($sortField, $sortDirection)
            ->latest()
            ->get();

        return AlergenResource::collection($alergens);
    }

    public function getAsTree()
    {
        return Alergen::getActiveAsTree(AlergenTreeResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlergenRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        $alergen = Alergen::create($data);

        return new AlergenResource($alergen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlergenRequest $request, Alergen $alergen)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;
        $alergen->update($data);

        return new AlergenResource($alergen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alergen $alergen)
    {
        $alergen->delete();

        return response()->noContent();
    }
}
