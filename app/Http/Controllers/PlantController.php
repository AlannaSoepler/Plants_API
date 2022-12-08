<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantCollection;
use App\Http\Resources\AlterPlantResource;
use App\Http\Resources\AlterPlantsResource;


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
        //dd(request('breed'));
        return new PlantCollection(Plant::with('provider')->with('shops')->get());
    }

    /**
    * Here i decide the jason structure that will be displayed in the post request. 
    * Here i tell it to elements from the plants table. I am not required to display them all. 
    * Here i make it possible for users to edit the elements. 
    */

    /**
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
        return new AlterPlantsResource($plant);
    }

    /**
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
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        $plant->update($request->only([
            'name', 'breed', 'image', 'info', 'season', 'hight', 'likes', 'provider_id'
        ]));

        //I want it to be done using the pivot table.
        //$plant->shops()->attach($request->plant);
        return new PlantResource($plant);
    }

     /**
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
