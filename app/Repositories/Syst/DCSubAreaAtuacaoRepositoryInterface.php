<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCSubareaAtuacao;
use Illuminate\Database\Eloquent\Model;

interface DCSubAreaAtuacaoRepositoryInterface
{
    public function __construct(DCSubareaAtuacao $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}