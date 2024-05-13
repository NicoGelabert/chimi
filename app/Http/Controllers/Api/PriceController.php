<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Http\Resources\PriceListResource;
use App\Http\Resources\PriceResource;
use App\Models\Api\Price;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PriceController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Price::query()
            ->where('size', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return PriceListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(PriceRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        
        $price = Price::create($data);
        
        // Buscamos la relación con el producto y le attacheamos el id para la tabla pivot
        $product = \App\Models\Product::findOrFail($data['product']);
        $price->products()->attach([$product->id]);

        return new PriceResource($price);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        $price->load('products');
        return new PriceResource($price);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Price      $price
     * @return \Illuminate\Http\Response
     */
    public function update(PriceRequest $request, Price $price)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $price->update($data);

        $product = \App\Models\Product::findOrFail($data['product']);
        $price->products()->sync([$product->id]);

        return new PriceResource($price);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $price->delete();

        return response()->noContent();
    }

}
