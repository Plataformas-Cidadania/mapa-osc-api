<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;

class ApiController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api",
     *     tags={"Api"},
     *     summary="Api do Mapa do Mapa v3",
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        return response()->json(['message' => 'API funcionando!']);
    }
}
