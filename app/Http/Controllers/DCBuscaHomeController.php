<?php

namespace App\Http\Controllers;

use App\Services\Spat\DCBuscaHomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class DCBuscaHomeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCBuscaHomeService $service
     */
    public function __construct(DCBuscaHomeService $_service)
    {
        $this->service = $_service;
    }

    public function getListaMunicipios($texto_busca)
    {
        try {
            return response()->json($this->service->getListaMunicipios($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getListaEstados($texto_busca)
    {
        try {
            return response()->json($this->service->getListaEstados($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getListaRegioes($texto_busca)
    {
        try {
            return response()->json($this->service->getListaRegioes($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaTodasLocalizacoes($texto_busca)
    {
        try {
            return response()->json($this->service->getListaTodasLocalizacoes($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
