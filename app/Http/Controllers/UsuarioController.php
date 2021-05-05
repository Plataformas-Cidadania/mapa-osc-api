<?php

namespace App\Http\Controllers;

use App\Models\Portal\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request) {
        //return [];
        //return ['tx_email_usuario' => 'teste@gmail.com'];
        //return ['tx_nome_usuario' => '', 'tx_email_usuario' => '', 'tx_senha_usuario' => ''];

        $user = new Usuario($request->all());

        return $user;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tx_nome_usuario' => 'required',
            'tx_email_usuario' => 'required|email',
            'tx_senha_usuario' => 'required'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['tx_senha_usuario'] = Hash::make($input['tx_senha_usuario']);
        $user = Usuario::create($input);

        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['tx_nome_usuario'] =  $user->tx_nome_usuario;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }
}
