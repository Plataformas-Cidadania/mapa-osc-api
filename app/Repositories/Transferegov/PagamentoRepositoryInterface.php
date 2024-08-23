<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Pagamento;

interface PagamentoRepositoryInterface
{
    public function __construct(Pagamento $_pagamento);

    public function get(int $nr_mov_fin, int $nr_convenio);

    public function getAll();

    public function store(array $data);

    public function update(int $nr_mov_fin, int $nr_convenio, array $data);

    public function destroy(int $nr_mov_fin, int $nr_convenio);

    public function updateOrCreate(array $data);
}