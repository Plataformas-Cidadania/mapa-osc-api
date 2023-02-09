<?php

namespace App\Http\Controllers;

use App\Models\Portal\DadosPerfilDeAcesso;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;



class DadosPerfilDeAcessoController extends Controller
{
    private $model;

    public function __construct(DadosPerfilDeAcesso $_dados_perfil_de_acesso)
    {
        $this->model = $_dados_perfil_de_acesso;
    }

    public function store(Request $request) {
        try {
            $data = $this->validate($request,[
                'tipo_perfil' => ['required', Rule::in(['membro_ou_representante_osc', 'gestor_ou_servidor_publico', 'pesquisador_ou_estudante', 'jornalista_ou_midia','outros'])]
            ]);
            $dados = $request->all();
            $dados['endereco_ip'] = $request->ip();
            return response()->json($this->model->create($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
