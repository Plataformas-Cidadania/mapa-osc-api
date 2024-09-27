<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCQualificacaoSocio;
use Illuminate\Database\Eloquent\Model;

interface DCQualificacaoSocioRepositoryInterface
{
    public function __construct(DCQualificacaoSocio $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}