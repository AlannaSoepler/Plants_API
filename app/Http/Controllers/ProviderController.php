<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderCollection;

class ProviderController extends Controller
{
   /**
     * Display a listing of the resource.
     *
        * @OA\Get(
        *     path="/api/providers",
        *     description="Displays all the plants",
        *     tags={"Providers"},
            *      @OA\Response(
                *          response=200,
                *          description="Successful operation, Returns a list of Plants in JSON format"
                *       ),
                *      @OA\Response(
                *          response=401,
                *          description="Unauthenticated",
                *      ),
                *      @OA\Response(
                *          response=403,
                *          description="Forbidden"
                *      )
        * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProviderCollection(Provider::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider = Provider::create($request->only([
            'name', 'logo', 'info', 'email', 'telephone'
        ]));
        return new ProviderResource($provider);
    }

    /**
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
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
