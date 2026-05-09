<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\TermoAditivo;

interface TermoAditivoRepositoryInterface
{
    public function __construct(TermoAditivo $_termo_aditivo);

    public function get(int $nr_convenio, string $numero_ta);

    public function getAll();

    public function store(array $data);

    public function update(int $nr_convenio, string $numero_ta, array $data);

    public function destroy(int $nr_convenio, string $numero_ta);

    public function updateOrCreate(array $data);
}