<?php


namespace App\Services\Portal;


use App\Repositories\Portal\BarratransparenciaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BarratransparenciaService
{
    private $repo;

    public function __construct(BarratransparenciaRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getBarraPorOSC($id_osc)
    {
        return $this->repo->getBarraPorOSC($id_osc);
    }

    public function getBarraPorOscComCalculo($id_osc)
    {
        return $this->repo->getBarraPorOscComCalculo($id_osc);
    }

    public function store(array $data)
    {
        // TODO: Implement update() method.
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id_osc)
    {
        // TODO: Implement update() method.
    }
}
