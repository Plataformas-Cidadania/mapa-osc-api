<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;

class ApiController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/example",
     *     summary="Exemplo de rota documentada",
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        return response()->json(['message' => 'API funcionando!']);
    }
}
