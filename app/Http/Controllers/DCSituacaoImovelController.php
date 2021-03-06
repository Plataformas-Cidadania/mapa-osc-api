<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCSituacaoImovel;
use App\Services\Syst\DCSituacaoImovelService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCSituacaoImovelController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCSituacaoImovelService $service
     */
    public function __construct(DCSituacaoImovelService $_service)
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

    public function get($id)
    {
        try {
            return response()->json($this->service->get($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {

    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
