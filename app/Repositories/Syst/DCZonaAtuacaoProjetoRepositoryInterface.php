<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCZonaAtuacaoProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCZonaAtuacaoProjetoRepositoryInterface
{
    public function __construct(DCZonaAtuacaoProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}