<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\EmpenhoDesembolso;

interface EmpenhoDesembolsoRepositoryInterface
{
    public function __construct(EmpenhoDesembolso $_meta);

    public function get(int $id_desembolso, string $id_empenho);

    public function getAll();

    public function store(array $data);

    public function update(int $id_desembolso, string $id_empenho, array $data);

    public function destroy(int $id_desembolso, string $id_empenho);

    public function updateOrCreate(array $data);
}