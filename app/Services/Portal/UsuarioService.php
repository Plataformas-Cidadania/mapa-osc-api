<?php


namespace App\Services\Portal;


use App\Repositories\Portal\UsuarioRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuarioService
{
    private $repo;

    public function __construct(UsuarioRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store(array $data)
    {
        $data['cd_tipo_usuario'] = 2;
        $data['bo_lista_email'] = true;
        $data['bo_ativo'] = true;
        $data['bo_email_confirmado'] = false;
        $data['dt_cadastro'] = date('Y-m-d H:i:s');
        $data['tx_senha_usuario'] = sha1($data['tx_senha_usuario']);
        $data['tx_hash_ativacao_usuario'] = Str::random(15);
        $usuario = $this->repo->store($data);
        //$this->enviaEmailAtivacao($usuario);
        return $usuario;
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id)
    {
        $this->destroy($id);
    }

    private function enviaEmailAtivacao($usuario){

        $data = [
            'name' => $usuario->tx_nome_usuario,
            'email' => $usuario->tx_email_usuario,
            'hash' => $usuario->tx_hash_ativacao_usuario,
            'id_usuario' => $usuario->id_usuario,
        ];

        $settings = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'name' => env('MAIL_FROM_NAME'),
        ];

        $usuario = env('MAIL_USERNAME', '');
        $password = env('MAIL_PASSWORD', '');

        Config::set('mail.host', env('MAIL_HOST'));
        Config::set('mail.port', env('MAIL_PORT'));
        Config::set('mail.address',$settings['from']);
        Config::set('mail.name', $settings['name']);
        Config::set('mail.username', $usuario);
        Config::set('mail.password', $password);
        //Config::set('mail.encryption', 'tls');

        //Log::info('nome usuario: '.$data['name']);
        //Log::info('email usuario: '.$data['email']);
        //Log::info('email from: '.$settings['from']);
        //Log::info('email name: '.$settings['name']);

        //mensagem para o usuario///////////////////////////////////////////////////////////////////////
        Mail::send('emails.usuario.ativar-usuario', ['data' => $data, 'settings' => $settings], function($message) use ($settings, $data)
        {
            $message->from($settings['from'], $settings['name']);
            $message->sender($settings['from'], $settings['name']);
            $message->to($data['email'], $data['name']);
            $message->replyTo($data['email'], $data['name']);
            $message->subject('Ativar Usuário - '.$settings['name']);

            //$message->priority($level);
            //$message->attach($pathToFile, array $options = []);
        });
        ////////////////////////////////////////////////////////////////////////////////////////////
    }

    public function activate($id, $hash){
       return $this->repo->activate($id, $hash);
    }

    public function trocarSenhaNaAreaRestrita(array $data)
    {
        $id_usuario = Auth::user()->id;
        $senha_atual = sha1($data['senha_atual']);
        $nova_senha = sha1($data['tx_senha_usuario']);

        return $this->repo->trocarSenhaNaAreaRestrita($id_usuario, $senha_atual, $nova_senha);
    }

    public function trocarSenha(array $data)
    {
        $id_usuario = $data['id_usuario'];
        $hash = $data['hash'];
        $senha = sha1($data['tx_senha_usuario']);

        return $this->repo->trocarSenha($id_usuario, $hash, $senha);
    }

    public function esqueciSenha(array $data)
    {

        $result = $this->repo->gerarLinkRedefinicaoSenha($data['email']);

        if($result){

            $data = [
                'id_usuario' => $result['id_usuario'],
                'name' => $result['name'],
                'email' => $result['email'],
                'hash' => $result['hash'],
                'date' => $result['name'],
            ];

            $settings = [
                'from' => env('MAIL_FROM_ADDRESS'),
                'name' => env('MAIL_FROM_NAME'),
            ];

            $usuario = env('MAIL_USERNAME', '');
            $password = env('MAIL_PASSWORD', '');

            Config::set('mail.host', env('MAIL_HOST'));
            Config::set('mail.port', env('MAIL_PORT'));
            Config::set('mail.address',$settings['from']);
            Config::set('mail.name', $settings['name']);
            Config::set('mail.username', $usuario);
            Config::set('mail.password', $password);
            //Config::set('mail.encryption', 'tls');

            Log::info('nome usuario: '.$data['name']);
            Log::info('email usuario: '.$data['email']);
            Log::info('email from: '.$settings['from']);
            Log::info('email name: '.$settings['name']);

            //mensagem para o usuario///////////////////////////////////////////////////////////////////////
            Mail::send('emails.usuario.redefinir-senha', ['data' => $data, 'settings' => $settings], function($message) use ($settings, $data)
            {
                $message->from($settings['from'], $settings['name']);
                $message->sender($settings['from'], $settings['name']);
                $message->to($data['email'], $data['name']);
                $message->replyTo($data['email'], $data['name']);
                $message->subject('Redefinir Senha - '.$settings['name']);

                //$message->priority($level);
                //$message->attach($pathToFile, array $options = []);
            });
            ////////////////////////////////////////////////////////////////////////////////////////////

            return true;
        }
        return false;
    }
}
