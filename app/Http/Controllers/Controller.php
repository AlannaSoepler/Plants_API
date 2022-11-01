<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//The annotation that are added here are used to generate the JSON. The generated JSON can be seen in api-docs.json
//The JSON is sent to the swagger view (index.blade.php)
 /**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Plants API",
 *      description="Alanna plant API",
 *      @OA\Contact(
 *          email="alanna.amrs@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
