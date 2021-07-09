<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCOrigemFonteRecursosProjeto;
use Illuminate\Database\Eloquent\Model;

interface DCOrigemFonteRecursosProjetoRepositoryInterface
{
    public function __construct(DCOrigemFonteRecursosProjeto $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}