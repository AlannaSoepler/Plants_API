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
    *          description="Successful operation, Returns a list of Providers in JSON format"
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
    * 
    * @OA\Post(
    *      path="/api/providers",
    *      operationId="create_provider",
    *      tags={"Providers"},
    *      summary="Create a Provider",
    *      description="Stores the provider in the DB",
    *      @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *            required={"name", "logo", "info", "email", "telephone"},
    *            @OA\Property(property="name", type="string", format="string", example="Plant inc."),
    *            @OA\Property(property="logo", type="string", format="string", example="https://xyz.com"),
    *            @OA\Property(property="info", type="string", format="string", example="Get wonderful plants"),
    *            @OA\Property(property="email", type="string", format="string", example="abc@gmail.com"),
    *            @OA\Property(property="likes", type="integer", format="integer", example="1")
    *          )
    *      ),
    *     @OA\Response(
    *          response=200, description="Success",
    *          @OA\JsonContent(
    *             @OA\Property(property="status", type="integer", example=""),
    *             @OA\Property(property="data",type="object")
    *          )
    *      )
    * ) 
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
     * 
     * @OA\Put(
     *      path="/api/providers",
     *      operationId="update_provider",
     *      tags={"Providers"},
     *      summary="Update a Provider",
     *      description="Stores the provider in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "logo", "info", "email", "telephone"},
     *            @OA\Property(property="name", type="string", format="string", example="Plant inc."),
     *            @OA\Property(property="logo", type="string", format="string", example="https://xyz.com"),
     *            @OA\Property(property="info", type="string", format="string", example="Get wonderful plants"),
     *            @OA\Property(property="email", type="string", format="string", example="abc@gmail.com"),
     *            @OA\Property(property="likes", type="integer", format="integer", example="1")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *      )
     * )
     * 
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
     * @OA\Delete(
     *    path="/api/providers/{id}",
     *    operationId="destroy_provider",
     *    tags={"Providers"},
     *    summary="Delete a Provider",
     *    description="Delete Provider",
     *    @OA\Parameter(name="id", in="path", description="Id of a Provider", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=204,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          )
     *       )
     *    )
     * )
     * 
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
