<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Usuario;
use Illuminate\Database\Eloquent\Model;

interface UsuarioRepositoryInterface
{
    public function __construct(Usuario $_usuario);

    public function getAll();

    public function get($id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);

    public function activate($id_usuario, $hash);

    public function gerarLinkRedefinicaoSenha($email);

    public function trocarSenha($id, $hash, $senha);

    public function trocarSenhaNaAreaRestrita($id, $senha_atual, $nova_senha);

}
