<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\ObtvConvenente;

interface ObtvConvenenteRepositoryInterface
{
    public function __construct(ObtvConvenente $_obtv_convenente);

    public function get(int $nr_mov_fin);

    public function getAll();

    public function store(array $data);

    public function update(int $nr_mov_fin, array $data);

    public function destroy(int $nr_mov_fin);

    public function updateOrCreate(array $data);
}