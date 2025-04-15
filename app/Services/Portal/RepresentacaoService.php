<?php


namespace App\Services\Portal;


use App\Repositories\Portal\RepresentacaoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RepresentacaoService
{
    private $repo;

    public function __construct(RepresentacaoRepositoryInterface $repo)
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

    public function getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario)
    {
        return $this->repo->where($id_osc, $id_usuario)->first();
    }

    public function store(array $data)
    {
        $data['id_usuario'] = Auth::user()->id_usuario;
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id_osc)
    {
        $id_usuario = Auth::user()->id_usuario;
        $representacao = $this->repo->getId($id_osc, $id_usuario);
        //Log::info($representacao);
        return $this->repo->destroy($representacao->id_representacao);
    }
}
