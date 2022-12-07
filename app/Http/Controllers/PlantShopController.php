<?php

namespace App\Http\Controllers;

use App\Models\PlantShop;
use Illuminate\Http\Request;
use App\Http\Resources\PlantShopResource;
use App\Http\Resources\PlantShopCollection;

class PlantShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PlantShopCollection(PlantShop::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plantShop = PlantShop::create($request->only([
            'plant_id', 'shop_id'
        ]));

        return new PlantShopResource($plantShop);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\PlantShop  $plantShop
    * @return \Illuminate\Http\PlantShopResource
    */
    public function show(PlantShop $plantShop)
    {
        return new PlantShopResource($plantShop);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\PlantShop  $plantShop
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,PlantShop $plantShop)
    {
        $plantShop->update($request->only([
            'plant_id', 'shop_id'
        ]));
        
        return new PlantShopResource($plantShop);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\PlantShop  $plantShop
    * @return \Illuminate\Http\Response
    */
    public function destroy(PlantShop $plantShop)
    {
        $plantShop->delete();
        return response()->json(null, 204);
    }
}
