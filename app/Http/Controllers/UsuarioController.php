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

    public function activate($id_usuario, $hash){
        try {

            $usuario = $this->service->activate($id_usuario, $hash);

            if ($usuario) {
                return redirect(env('FRONT_URL')."/usuario-ativado");
                //return response()->json(['Resposta' => 'Representante (Usuário) da OSC atualizado com sucesso!'], Response::HTTP_OK);
            }

            return redirect(env('FRONT_URL')."/ativacao-invalida");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function trocarSenha(Request $request){
        try {
            $dados = $request->all();

            $usuario = $this->service->trocarSenha($dados['form']);

            if ($usuario) {
                return response()->json(['Resposta' => 'Senha atualizada com sucesso!'], Response::HTTP_OK);
            }

            return response()->json(['Resposta' => 'Código inválido ou expirado!'], Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function esqueciSenha(Request $request){
        try {
            $dados = $request->all();

            $usuario = $this->service->esqueciSenha($dados);

            if ($usuario) {
                return response()->json(['Resposta' => 'Link de recuperação de senha Gerado! Verifique o seu email!'], Response::HTTP_OK);
            }

            return response()->json(['Resposta' => 'E-mail inválido!'], Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return response()->json(['Resposta' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
