<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCObjetivoProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCObjetivoProjetoRepositoryInterface
{
    public function __construct(DCObjetivoProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}