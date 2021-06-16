<?php

namespace App\Http\Controllers;

use App\Services\Ipeadata\DCIpeadataMunicipioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCIpeadataMunicipioController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCIpeadataMunicipioService $service
     */
    public function __construct(DCIpeadataMunicipioService $_service)
    {
        $this->service = $_service;
    }

    public function getAll()
    {
        try {
            return response()->json($this->service->getAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllPorEstado($id_estado)
    {
        try {
            return response()->json($this->service->getAllPorEstado($id_estado), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get($id)
    {
        try {
            return response()->json($this->service->get($id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
