<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Emenda;

interface EmendaRepositoryInterface
{
    public function __construct(Emenda $_emenda);

    public function get(int $seq_emenda);

    public function getAll();

    public function store(array $data);

    public function update(int $seq_emenda, array $data);

    public function destroy(int $seq_emenda);

    public function updateOrCreate(array $data);
}