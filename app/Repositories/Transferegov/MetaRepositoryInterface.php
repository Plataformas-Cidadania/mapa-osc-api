<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Meta;

interface MetaRepositoryInterface
{
    public function __construct(Meta $_meta);

    public function get(int $id_meta, string $id_proposta);

    public function getAll();

    public function store(array $data);

    public function update(int $id_meta, string $id_proposta, array $data);

    public function destroy(int $id_meta, string $id_proposta);

    public function updateOrCreate(array $data);
}