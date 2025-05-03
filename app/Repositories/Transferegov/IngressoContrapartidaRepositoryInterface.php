<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\IngressoContrapartida;

interface IngressoContrapartidaRepositoryInterface
{
    public function __construct(IngressoContrapartida $_ingresso_contrapartida);

    public function get(int $nr_convenio, string $dt_ingresso_contrapartida);

    public function getAll();

    public function store(array $data);

    public function update(int $nr_convenio, string $dt_ingresso_contrapartida, array $data);

    public function destroy(int $nr_convenio, string $dt_ingresso_contrapartida);

    public function updateOrCreate(array $data);
}