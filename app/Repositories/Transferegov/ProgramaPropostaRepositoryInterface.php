<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\ProgramaProposta;

interface ProgramaPropostaRepositoryInterface
{
    public function __construct(ProgramaProposta $_projeto);

    public function get($id_programa, $id_proposta);

    public function getAll();

    public function store(array $data);

    public function update($id_programa, $id_proposta, array $data);

    public function destroy($id);

    public function updateOrCreate(array $data);
}