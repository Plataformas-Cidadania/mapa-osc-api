<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCSituacaoImovel;
use Illuminate\Database\Eloquent\Model;

interface DCSituacaoImovelRepositoryInterface
{
    public function __construct(DCSituacaoImovel $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}