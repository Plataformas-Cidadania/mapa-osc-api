<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Prorroga;

interface ProrrogaRepositoryInterface
{
    public function __construct(Prorroga $_prorroga);

    public function get(int $nr_convenio, string $nr_prorroga);

    public function getAll();

    public function store(array $data);

    public function update(int $nr_convenio, string $nr_prorroga, array $data);

    public function destroy(int $nr_convenio, string $nr_prorroga);

    public function updateOrCreate(array $data);
}