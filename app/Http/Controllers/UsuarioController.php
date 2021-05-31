<?php

namespace App\Http\Controllers;

use App\Models\Portal\Usuario;
use App\Services\Portal\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /*public function store(Request $request) {
        //return [];
        //return ['tx_email_usuario' => 'teste@gmail.com'];
        //return ['tx_nome_usuario' => '', 'tx_email_usuario' => '', 'tx_senha_usuario' => ''];

        $user = new Usuario($request->all());

        return $user;
    }*/

    public function store(Request $request)
    {
        $data = $request->all();
        $data['nr_cpf_usuario'] = preg_replace('/[^0-9]/', '', $data['nr_cpf_usuario']);
        $validator = Validator::make($data, [
            'tx_nome_usuario' => 'required',
            'tx_email_usuario' => 'required|email|unique:pgsql.portal.tb_usuario',
            'tx_senha_usuario' => 'required',
            'nr_cpf_usuario' => 'required|unique:pgsql.portal.tb_usuario'
        ]);

        //return $request->all();

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $user = $this->service->store($data);
        /**Take note of this: Your user authentication access token is generated here **/
        //$data['token'] =  $user->createToken('MyApp')->accessToken;
        //$data['tx_nome_usuario'] =  $user->tx_nome_usuario;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }

    public function getUserAuth(){
        return Auth::user();
    }
}
