<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Proponente;

interface ProponenteRepositoryInterface
{
    public function __construct(Proponente $_proponente);

    public function get(int $id_proponente, string $identif_proponente);

    public function getAll();

    public function store(array $data);

    public function update(int $id_proponente, string $identif_proponente, array $data);

    public function destroy(int $id_proponente, string $identif_proponente);

    public function updateOrCreate(array $data);
}