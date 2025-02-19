<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *   title="Mapa OSC Data API",
     *   version="1.0",
     *   description="This is an API that scrape data from https://www.mapaosc.ipea.gov.br/ and serve the data in JSON format",
     *   @OA\Contact(
     *     email="mapaosc@gmail.com",
     *     name="Mapa das OSCs"
     *   )
     * )
     */
}
