<?php

namespace App\Http\Controllers;

use App\Services\Ipeadata\DCIpeadataService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCIpeadataController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCIpeadataService $service
     */
    public function __construct(DCIpeadataService $_service)
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
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
