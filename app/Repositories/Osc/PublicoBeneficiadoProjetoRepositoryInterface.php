<?php


namespace App\Repositories\Osc;


use App\Models\Osc\PublicoBeneficiadoProjeto;
use Illuminate\Database\Eloquent\Model;

interface PublicoBeneficiadoProjetoRepositoryInterface
{
    public function __construct(PublicoBeneficiadoProjeto $_publico);

    public function get($id);

    public function getPublicoBeneficiadoPorProjeto($_id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}