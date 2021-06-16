<?php

namespace App\Http\Controllers;

use App\Services\Ipeadata\DCIpeadataUffService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCIpeadataUffController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCIpeadataUffService $service
     */
    public function __construct(DCIpeadataUffService $_service)
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

    public function getAllPorRegiao($id_regiao)
    {
        try {
            return response()->json($this->service->getAllPorRegiao($id_regiao), Response::HTTP_OK);
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
