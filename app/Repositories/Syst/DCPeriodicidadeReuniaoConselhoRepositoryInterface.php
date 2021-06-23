<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCPeriodicidadeReuniaoConselho;
use Illuminate\Database\Eloquent\Model;

interface DCPeriodicidadeReuniaoConselhoRepositoryInterface
{
    public function __construct(DCPeriodicidadeReuniaoConselho $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}