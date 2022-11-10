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
    * @OA\Get(
    *     path="/api/providers",
    *     summary="Get all Providers",
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
    * @OA\Get(
    *     path="/api/providers/{id}",
    *     summary="Get Providers by ID",
    *     description="Gets a provider by ID",
    *     tags={"Providers"},
    *          @OA\Parameter(
    *          name="id",
    *          description="provider id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer")
    *          ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation"
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
