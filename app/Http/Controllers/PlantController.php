<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantRequest;
use App\Http\Resources\PlantCollection;
use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\Request;


class PlantController extends Controller
{
    /**
    * Swagger is used to help describe the structure of the API so that machines can read them. 
    * Swagger helps to build interactive API documentation.
    * The paths is the same as if the user would have requested a get request from the url
    * The requests will be displayed under the PLants tag. To keep it organized 
    * The responses will show depending on if the request is a success nor if the user is trying to make an 
    * illegal or forbidden request. 
    */

   /** 
    * @OA\Get(
    *     path="/api/plants",
    *     summary="Get all Plants",
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
    * Display a listing of the resource.
    * 
    * The user sends a get request though the URL. 
    * This gets request will display all the plants in the plant table. 
    * Using the route defined in the API.php it calls the index function in the plant controller and the index function. 
    * From here it takes all the data from the plant table and send it to the plant collection. 
    * In the plant collection it will transform the resources into an array.
    * 
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return new PlantCollection(Plant::with('provider')->with('shops')->get());
    }

    /**
    * Here i decide the jason structure that will be displayed in the post request. 
    * Here i tell it to elements from the plants table. I am not required to display them all. 
    * Here i make it possible for users to edit the elements. 
    */

    /**
    * @OA\Post(
    *      path="/api/plants",
    *      operationId="store",
    *      tags={"Plants"},
    *      summary="Create a new Plant",
    *      description="Stores the plant in the DB",
    *      security={{"bearerAuth":{}}},
    *      @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *            required={"name", "breed", "image", "info", "season", "hight","likes","provider_id"},
    *            @OA\Property(property="name", type="string", format="string", example="hibiscus"),
    *            @OA\Property(property="breed", type="string", format="string", example="malvaceae"),
    *            @OA\Property(property="image", type="string", format="string", example="https://xyz.com"),
    *            @OA\Property(property="info", type="string", format="string", example="the hibiscus is a wonderful plant"),
    *            @OA\Property(property="season", type="string", enum={"summer", "fall", "winter", "spring"}, default="summer"),
    *            @OA\Property(property="hight", type="integer", format="integer", example="1"),
    *            @OA\Property(property="likes", type="integer", format="integer", example="1"),
    *            @OA\Property(property="provider_id", type="number", example="1")
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
    * Store a newly created resource in the plant table.
    * The user sends a post request though the URL. 
    * Using the route defined in the API.php it calls the store function in the plant controller. 
    * From here it takes all the data that was given by the user and stores it in the $plant variable 
    * and then sends the data in the variable to the plant resource. 
    * 
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StorePlantRequest $request)
    {
        $plant = Plant::create($request->only([
            'name', 'breed', 'image', 'info', 'season', 'hight', 'likes', 'provider_id'
        ]));

        $plant->shops()->attach($request->shops);
        return new PlantResource($plant);
    }

    /**
    * @OA\Get(
    *     path="/api/plants/{id}",
    *     summary="Get Plant by ID",
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
    * 
    * Display the specified resource. 
    * The user send a get request and the endpoint being the plant id. 
    * The route in the api.php calls the plant controller and the show function 
    * Instead of having a single id passed in. The this function now takes the entire model.
    * It find the plant with the intended id and stores it in $plant. 
    * From here it gets sent off to the plant resource which converts it into json. 
    * 
    * @param  \App\Models\Plant  $plant
    * @return \Illuminate\Http\PlantResource
    */
    public function show(Plant $plant)
    {
        return new PlantResource($plant);
    }
    /**
    * @OA\Put(
    *      path="/api/plants",
    *      operationId="update",
    *      tags={"Plants"},
    *      summary="Update a Plant",
    *      description="Stores the plant in the DB",
    *      security={{"bearerAuth":{}}},
    *         @OA\Parameter(
    *          name="id",
    *          description="Plant id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *          type="integer")
    *          ),
    *      @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *            required={"id","name", "breed", "image", "info", "season", "hight","likes", "provider_id"},
    *            @OA\Property(property="id", type="number" example="1"),
    *            @OA\Property(property="name", type="string", format="string", example="hibiscus"),
    *            @OA\Property(property="breed", type="string", format="string", example="malvaceae"),
    *            @OA\Property(property="image", type="string", format="string", example="https://xyz.com"),
    *            @OA\Property(property="info", type="string", format="string", example="the hibiscus is a wonderful plant"),
    *            @OA\Property(property="season", type="string", enum={"summer", "fall", "winter", "spring"}, default="summer"),
    *            @OA\Property(property="hight", type="integer", format="integer", example="1"),
    *            @OA\Property(property="likes", type="integer", format="integer", example="1"),
    *            @OA\Property(property="provider", type="string", format="string", example="ThePlant.inc"),
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
    * Update the specified resource in the plant table.
    * The user sends a put request though the URL. This gets request will display all the plants in the plant table. 
    * Using the route defined in the API.php it calls the update function in the plant controller. 
    * From here it takes all the data that was given by the user and stores it in the $plant variable and 
    * then sends the data in the variable to the plant collection. However, using the put request will completely delete and recreate.   
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Plant  $plant
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Plant $plant)
    {
        $plant->update($request->only([
            'name', 'breed', 'image', 'info', 'season', 'hight', 'likes', 'provider_id'
        ]));
        
        //$plant->shops()->attach($request->plant);
        return new PlantResource($plant);
    }

     /**
     * @OA\Delete(
     *    path="/api/plants/{id}",
     *    operationId="destroy",
     *    tags={"Plants"},
     *    summary="Delete a Plant",
     *    description="Delete Plant",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of a Plant", required=true,
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
     * Remove the specified resource from the plants table.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        $plant->shops()->detach();
        $plant->delete();
        // return response()->json(null, response::HTTP_NO_CONTENT);
        //returns a http response of 204 (no content), if there is no content to display
        return response()->json(null, 204);

    }
}
