<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsuarioRepositoryEloquent implements UsuarioRepositoryInterface
{
    private $model;

    public function __construct(Usuario $_usuario)
    {
        $this->model = $_usuario;
    }

    public function getAll()
    {
        return $this->model->with('osc')->with('usuario')->get();//->whereIn('id_usuario', [1, 250, 251]);//->orderBy('id_usuario', 'asc');
    }

    public function get($id)
    {
        return $this->model->with('usuario')->with('osc')->where('id_usuario', $id)->get();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
    public function activate($id, $hash)
    {
        $usuario = $this->model->where('id_usuario', $id)->where('tx_hash_ativacao_usuario', $hash)->first();
        if($usuario){
            return $usuario->update([
                'bo_ativo' => 1,
                'bo_email_confirmado' => 1
            ]);
        }
        return false;
    }

    public function gerarLinkRedefinicaoSenha($email)
    {
        $date = Date('Y-m-d');
        $usuario = $this->model->where('tx_email_usuario', $email)->first();
        $hash = Str::random(15);
        if($usuario){
            DB::table('portal.tb_recuperacao_senhas_usuario')->insert(
                [
                    'id_usuario' => $usuario->id_usuario,
                    'tx_hash' => $hash,
                    'dt_expiracao' => $date
                ]
            );

            return [
                'id_usuario' => $usuario->id_usuario,
                'name' => $usuario->tx_nome_usuario,
                'email' => $usuario->tx_email_usuario,
                'date' => $date,
                'hash' => $hash
            ];

        }
        return false;
    }

    public function trocarSenha($id, $hash, $senha)
    {
        $date = Date('Y-m-d');
        $recuperacao = DB::table('portal.tb_recuperacao_senhas_usuario')
            ->where('id_usuario', $id)
            ->where('tx_hash', $hash)
            ->where('dt_expiracao', '>=', $date)
            ->first();
        if($recuperacao){
            $usuario = $this->model->find($id);
            return $usuario->update([
                'tx_senha_usuario' => $senha,
            ]);
        }
        return false;
    }

    public function trocarSenhaNaAreaRestrita($id, $senha_atual, $nova_senha)
    {
        $usuario = DB::table('portal.tb_usuario')
            ->where('id_usuario', $id)
            ->where('tx_senha_usuario', $senha_atual)
            ->first();
        if($usuario){
            $usuario = $this->model->find($id);
            return $usuario->update([
                'tx_senha_usuario' => $nova_senha,
            ]);
        }
        return false;
    }
}
