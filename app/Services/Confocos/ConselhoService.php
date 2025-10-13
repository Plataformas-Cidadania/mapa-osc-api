<?php


namespace App\Services\Confocos;

use App\Models\Portal\Usuario;
use App\Repositories\Confocos\ConselhoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ConselhoService
{
    private $repo;

    public function __construct(ConselhoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getPorId($id)
    {
        return $this->repo->getPorId($id);
    }

    public function getNumeroTotalConselhos()
    {
        return $this->repo->getNumeroTotalConselhos();
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id_conselho)
    {
        return $this->repo->delete($id_conselho);
    }

    public function getListaConselhosUsuarioAutenticado(){
        $conselhos = Auth::user()->conselhos;
        $idsConselhos = [];
        foreach ($conselhos as $conselho) {
            array_push($idsConselhos, $conselho->id_conselho);
        }
        return $this->repo->getListaConselhosPorIds($idsConselhos);
    }

    public function getListaConselhosPorNivelFederativo($cd_nivel_federativo, $limit)
    {
        $quantitativo = $this->repo->getListaConselhosPorNivelFederativo($cd_nivel_federativo, $limit);

        return $quantitativo;
    }

    //    public function getListaOscCnpjAutocomplete($cnpj){
//        return $this->repo->getListaOscCnpjAutocomplete($cnpj);
//    }
//
//    public function getListaOscNomeCnpjAutocomplete($texto_busca){
//
//        return $this->repo->getListaOscNomeCnpjAutocomplete($texto_busca);
//    }
}
