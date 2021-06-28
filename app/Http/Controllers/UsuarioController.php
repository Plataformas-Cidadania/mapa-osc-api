<?php

namespace App\Http\Controllers;

use App\Models\Portal\Usuario;
use App\Services\Portal\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(UsuarioService $_service)
    {
        $this->service = $_service;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['nr_cpf_usuario'] = preg_replace('/[^0-9]/', '', $data['nr_cpf_usuario']);
            $validator = Validator::make($data, [
                'tx_nome_usuario' => 'required',
                'tx_email_usuario' => 'required|email|unique:pgsql.portal.tb_usuario',
                'tx_senha_usuario' => 'required',
                'nr_cpf_usuario' => 'required|unique:pgsql.portal.tb_usuario'
            ]);

            if($validator->fails()){
                return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
            }

            $user = $this->service->store($data);

            return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserAuth(){
        return Auth::user();
    }

    public function update($id_usuario, Request $request) {
        try {
            $dados = $request->all();

            $usuario = $this->service->update($id_usuario, $dados);

            if ($usuario) {
                return response()->json(['Resposta' => 'Representante (Usuário) da OSC atualizado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
