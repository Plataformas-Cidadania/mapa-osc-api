<?php

namespace App\Http\Controllers;

use App\Models\Osc\QuadroSocietario;
use App\Services\Osc\QuadroSocietarioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuadroSocietarioController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param QuadroSocietarioService $service
     */
    public function __construct(QuadroSocietarioService $_service)
    {
        $this->service = $_service;
    }

    public function get($id)
    {
        try {
            $quadro_societario = $this->service->get($id);
            if (is_null($quadro_societario))
            {
                return response()->json(['Resposta' => 'Quadro Societario não encontrado!'], Response::HTTP_OK);
            }

            return $quadro_societario;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getQuadroSocietarioPorOSC($id_osc)
    {
        try {
            $quadro_societarios = $this->service->getQuadroSocietarioPorOSC($id_osc);

            if (count($quadro_societarios) == 0)
            {
                return response()->json(['Resposta' => 'Nenhuma Quadro Societario foi encontrado para essa OSC!'], Response::HTTP_OK);
            }

            return $quadro_societarios;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();

            //Retorna novo registro
            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $quadro_societario = $this->service->update($id, $dados);

            if ($quadro_societario)
            {
                return response()->json(['Resposta' => 'Quadro Societario atualizada com sucesso!'], Response::HTTP_OK);
            }

            return $quadro_societario;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_quadro_societario) {
        try {
            if ($this->service->delete($id_quadro_societario))
            {
                return response()->json(['Resposta' => 'Quadro Societario deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
