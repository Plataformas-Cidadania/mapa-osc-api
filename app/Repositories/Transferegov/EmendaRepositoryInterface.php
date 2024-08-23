<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Emenda;

interface EmendaRepositoryInterface
{
    public function __construct(Emenda $_emenda);

    public function get(int $cod_programa_emenda, $beneficiario_emenda, $nr_emenda);

    public function getAll();

    public function store(array $data);

    public function update(int $cod_programa_emenda, $beneficiario_emenda, $nr_emenda, array $data);

    public function destroy(int $cod_programa_emenda, $beneficiario_emenda, $nr_emenda);

    public function updateOrCreate(array $data);
}