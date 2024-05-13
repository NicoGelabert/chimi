<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlergenRequest;
use App\Http\Resources\AlergenListResource;
use App\Http\Resources\AlergenResource;
use App\Models\Api\Alergen;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class AlergenController extends Controller
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


        $query = Alergen::query()
            ->where('name', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);


        return AlergenListResource::collection($query);
    }


    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(AlergenRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;
        // Check if image was given and save on local file system
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }

        $alergen = Alergen::create($data);

        return new AlergenResource($alergen);
    }


    /**
     * Display the specified resource.
     * @param \App\Models\Alergen $alergen
     * @return \Illuminate\Http\Response
     */

    public function show(Alergen $alergen)
    {
        return new AlergenResource($alergen);
    }


    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alergen      $alergen
     * @return \Illuminate\Http\Response
     */

    public function update(AlergenRequest $request, Alergen $alergen)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;
        // Check if image was given and save on local file system
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            // If there is an old image, delete it
            if ($alergen->image) {
                Storage::deleteDirectory('/public/' . dirname($alergen->image));
            }
        }

        $alergen->update($data);

        return new AlergenResource($alergen);
    }


    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Alergen $alergen
     * @return \Illuminate\Http\Response
     */

    public function destroy(Alergen $alergen)
    {
        $alergen->delete();

        return response()->noContent();
    }
    

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }


        return $path . '/' . $image->getClientOriginalName();
    }

}
