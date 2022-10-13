<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantCollection;
use App\Http\Resources\PlantResource;
use App\Models\Plant;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PlantCollection(Plant::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plant = Plant::create($request->only([
            'name', 'breed', 'image', 'info', 'season', 'environment', 'hight', 'provider', 'available', 'likes'
        ]));
        return new PlantResource($plant);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\PlantResource
     */
    public function show(Plant $plant)
    {
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plant $plant)
    {
        $plant->update($request->only([
            'name', 'breed', 'image', 'info', 'season', 'environment', 'hight', 'provider', 'available', 'likes'
        ]));

        return new PlantResource($plant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return response()->json(null, 204);
    }
}
