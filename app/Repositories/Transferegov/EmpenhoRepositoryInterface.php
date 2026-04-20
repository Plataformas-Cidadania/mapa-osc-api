<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Empenho;

interface EmpenhoRepositoryInterface
{
    public function __construct(Empenho $_empenho);

    public function get(int $id_empenho, int $nr_convenioa);

    public function getAll();

    public function store(array $data);

    public function update(int $id_empenho, int $nr_convenio, array $data);

    public function destroy(int $id_empenho, int $nr_convenio);

    public function updateOrCreate(array $data);
}