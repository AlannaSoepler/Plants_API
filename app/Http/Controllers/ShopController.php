<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopCollection;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ShopCollection(Shop::with('plants')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        $shop = Shop::create($request->only([
            'name', 'address', 'info'
        ]));

        $shop->plants()->attach($request->plants);
        return new ShopResource($shop);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Shop  $shop
    * @return \Illuminate\Http\Response
    */
    public function show(Shop $shop)
    {
        return new ShopResource($shop);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Shop  $shop
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop->update($request->only([
            'name', 'address', 'info'
        ]));

        //I want it to be done using the pivot table.
        //$shop->plants()->attach($request->shop);
        return new ShopResource($shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->plants()->detach();
        $shop->delete();
        // return response()->json(null, response::HTTP_NO_CONTENT);
        //returns a http response of 204 (no content), if there is no content to display
        return response()->json(null, 204);
    }
}
