<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCAbrangenciaProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCAbrangenciaProjetoRepositoryInterface
{
    public function __construct(DCAbrangenciaProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}