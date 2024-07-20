<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Programa;

interface ProgramaRepositoryInterface
{
    public function __construct(Programa $_projeto);

    public function get($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa);

    public function getAll();

    public function store(array $data);

    public function update($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa, array $data);

    public function destroy($id);

    public function updateOrCreate(array $data);
}