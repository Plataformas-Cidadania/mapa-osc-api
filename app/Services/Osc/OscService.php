<?php


namespace App\Services\Osc;

use App\Repositories\Osc\OscRepositoryInterface;

class OscService
{
    private $repo;

    public function __construct(OscRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getNumeroTotalOSCs()
    {
        return $this->repo->getNumeroTotalOSCs();
    }

    public function getCabecalho($id)
    {
        return $this->repo->getCabecalho($id);
    }

    public function getDadosGerais($id)
    {
        return $this->repo->getDadosGerais($id);
    }

    public function updateDadosGerais($id, $data)
    {
        return $this->repo->updateDadosGerais($id, $data);
    }

    public function getRelTrabalhoAndGovernanca($id)
    {
        return $this->repo->getRelTrabalhoAndGovernanca($id);
    }

    public function getProjetos($id)
    {
        return $this->repo->getProjetos($id);
    }

    public function getParticipacaoSocial($id)
    {
        return $this->repo->getParticipacaoSocial($id);
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function getListaOscAtualizadas($tam_lista)
    {
        return $this->repo->getListaOscAtualizadas($tam_lista);
    }

    public function getGrafico($tipo_graf)
    {
        return $this->repo->getGrafico($tipo_graf);
    }
}