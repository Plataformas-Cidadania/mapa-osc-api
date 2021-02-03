<?php


namespace App\Repositories\Osc;


use App\Models\Osc\LocalizacaoProjeto;
use Illuminate\Database\Eloquent\Model;

interface LocalizacaoProjetoRepositoryInterface
{
    public function __construct(LocalizacaoProjeto $localizacaoProjeto);

    public function get($id);

    public function getLocalizacoesPorProjeto($id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}