<?php


namespace App\Repositories\Confocos;


use App\Models\Confocos\Conselho;
use Illuminate\Database\Eloquent\Model;

interface ConselhoRepositoryInterface
{
    public function __construct(Conselho $_conselho);

    public function getAll();

    public function getPorId($id);

    public function store(array $data);

    public function destroy($id);

    public function getNumeroTotalConselhos();

    public function update($id_conselho, array $data);

    public function getListaConselhosPorNivelFederativo($cd_nivel_federativo, $limit);

    public function getListaConselhosPorIds(array $ids);

//    public function getListaOscCnpjAutocomplete($cnpj);

//    public function getListaOscNomeCnpjAutocomplete($texto_busca);
}
