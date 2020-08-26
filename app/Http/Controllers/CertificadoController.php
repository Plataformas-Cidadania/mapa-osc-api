<?php

namespace App\Http\Controllers;

use App\Models\Osc\Certificado;
use App\Services\Osc\CertificadoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificadoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param CertificadoService $service
     */
    public function __construct(CertificadoService $_service)
    {
        $this->service = $_service;
    }

    public function get($id)
    {
        try {
            $certificado = $this->service->get($id);
            if (is_null($certificado))
            {
                return response()->json(['Resposta' => 'Certificado não encontrado!'], Response::HTTP_OK);
            }

            return $certificado;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCertificadosPorOSC($id_osc)
    {
        try {
            $certificados = $this->service->getCertificadosPorOSC($id_osc);

            if (count($certificados) == 0)
            {
                return response()->json(['Resposta' => 'Nenhum Certificado foi encontrado para essa OSC!'], Response::HTTP_OK);
            }

            return $certificados;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();

            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $certificado = $this->service->update($id, $dados);

            if ($certificado)
            {
                return response()->json(['Resposta' => 'Certificado atualizado com sucesso!'], Response::HTTP_OK);
            }

            return $certificado;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_certificado) {
        try {
            if ($this->service->delete($id_certificado))
            {
                return response()->json(['Resposta' => 'Certificado deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
