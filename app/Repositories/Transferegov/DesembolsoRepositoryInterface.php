<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Desembolso;

interface DesembolsoRepositoryInterface
{
    public function __construct(Desembolso $_desembolso);

    public function get(int $id_desembolso, int $nr_convenioa);

    public function getAll();

    public function store(array $data);

    public function update(int $id_desembolso, int $nr_convenio, array $data);

    public function destroy(int $id_desembolso, int $nr_convenio);

    public function updateOrCreate(array $data);
}