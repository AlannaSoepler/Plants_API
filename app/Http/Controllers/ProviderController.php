<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderCollection;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;

class ProviderController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // return new ProviderCollection(Provider::all());
        return new ProviderCollection(Provider::paginate(1));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\StoreProviderRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StoreProviderRequest $request)
    {
        $provider = Provider::create($request->only([
            'name', 'logo', 'info', 'email', 'telephone'
        ]));
        return new ProviderResource($provider);
    }

    /**
    *
    * Display the specified resource.
    *
    * @param  \App\Models\Provider  $provider
    * @return \Illuminate\Http\Response
    */
    public function show(Provider $provider)
    {
        return new ProviderResource($provider);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\UpdateProviderRequest  $request
    * @param  \App\Models\Provider  $provider
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->only([
            'name', 'logo', 'info', 'email', 'telephone'
        ]));
        return new ProviderResource($provider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json(null, 204);
    }
}
