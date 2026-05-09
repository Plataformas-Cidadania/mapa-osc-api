<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Etapa;

interface EtapaRepositoryInterface
{
    public function __construct(Etapa $_etapa);

    public function get(int $id_etapa, int $id_meta, int $nr_etapa);

    public function getAll();

    public function store(array $data);

    public function update(int $id_etapa, int $id_meta, int $nr_etapa, array $data);

    public function destroy(int $id_etapa, int $id_meta, int $nr_etapa);

    public function updateOrCreate(array $data);
}