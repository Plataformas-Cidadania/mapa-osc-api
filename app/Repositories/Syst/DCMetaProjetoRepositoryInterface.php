<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCMetaProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCMetaProjetoRepositoryInterface
{
    public function __construct(DCMetaProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function getMetasPorObjetivo($_id_objetivo);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}