<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCStatusProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCStatusProjetoRepositoryInterface
{
    public function __construct(DCStatusProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}