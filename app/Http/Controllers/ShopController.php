<?php

namespace App\Http\Controllers;

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
        return new ShopCollection(Shop::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = Shop::create($request->only([
            'name', 'address', 'info'
        ]));

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
    public function update(Request $request, Shop $shop)
    {
        $shop->update($request->only([
            'name', 'address', 'image'
        ]));
        
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
        //$shop->shops()->detach();
        $shop->delete();
        // return response()->json(null, response::HTTP_NO_CONTENT);
        //returns a http response of 204 (no content), if there is no content to display
        return response()->json(null, 204);
    }
}
