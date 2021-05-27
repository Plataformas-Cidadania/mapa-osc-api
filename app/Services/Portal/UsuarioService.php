<?php


namespace App\Services\Portal;


use App\Repositories\Portal\UsuarioRepositoryInterface;

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
        $data['bo_lista_email'] = 1;
        $data['bo_ativo'] = 1;
        $data['dt_cadastro'] = date('Y-m-d');
        $data['tx_senha_usuario'] = sha1($data['tx_senha_usuario']);
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
