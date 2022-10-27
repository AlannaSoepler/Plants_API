<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantCollection;
use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Response;
// use Illuminate\Http\Response;


class PlantController extends Controller
{
   /**
     * Display a listing of the resource.
     *
 * @OA\Get(
 *     path="/api/plants",
 *     description="Displays all the plants",
 *     tags={"Plants"},
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
        return new PlantCollection(Plant::all());
    }

    /**
     * Store a newly created resource in storage.
     * * @OA\Post(
     *      path="/api/plants",
     *      operationId="store",
     *      tags={"Plants"},
     *      summary="Create a new Plant",
     *      description="Stores the plant in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "breed", "image", "info", "season", "environment", "hight", "provider", "available", "likes"},
     *            @OA\Property(property="name", type="string", format="string", example="hibiscus"),
     *            @OA\Property(property="breed", type="string", format="string", example="malvaceae"),
     *            @OA\Property(property="image", type="string", format="string", example="https://xyz.com"),
     *            @OA\Property(property="info", type="string", format="string", example="the hibiscus is a wonderful plant"),
     *            @OA\Property(property="season", type="string", enum={"summer", "fall", "winter", "spring"}, default="summer"),
     *            @OA\Property(property="environment", type="string", format="string", example="Sunny"),
     *            @OA\Property(property="hight", type="integer", format="integer", example="1"),
     *            @OA\Property(property="provider", type="string", format="string", example="ThePlant.inc"),
     *            @OA\Property(property="available", type="boolean", format="boolean", example="1"),
     *             @OA\Property(property="likes", type="integer", format="integer", example="1")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
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
      * @OA\Get(
    *     path="/api/plants/{id}",
    *     description="Gets a plant by ID",
    *     tags={"Plants"},
    *          @OA\Parameter(
        *          name="id",
        *          description="Plant id",
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
     * @OA\Delete(
     *    path="/api/plants/{id}",
     *    operationId="destroy",
     *    tags={"Plants"},
     *    summary="Delete a Plant",
     *    description="Delete Plant",
     *    @OA\Parameter(name="id", in="path", description="Id of a Plant", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=204,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();
        // return response()->json(null, response::HTTP_NO_CONTENT);
        return response()->json(null, 204);

    }
}
