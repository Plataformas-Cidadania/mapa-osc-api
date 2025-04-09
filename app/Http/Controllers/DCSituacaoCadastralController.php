<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCSituacaoCadastral;
use App\Services\Syst\DCSituacaoCadastralService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCSituacaoCadastralController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCSituacaoCadastralService $service
     */
    public function __construct(DCSituacaoCadastralService $_service)
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
        try {
            $dados = $request->all();

            return response()->json($this->service->update($id, $dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
