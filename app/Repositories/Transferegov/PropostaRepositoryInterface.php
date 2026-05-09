<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Proposta;

interface PropostaRepositoryInterface
{
    public function __construct(Proposta $_proposta);

    public function get($id_proposta);

    public function getAll();

    public function store(array $data);

    public function update($id_proposta, array $data);

    public function destroy($id);

    public function updateOrCreate(array $data);
}