<?php


namespace App\Repositories\Osc;


use App\Models\Osc\QuadroSocietario;

interface QuadroSocietarioRepositoryInterface
{
    public function __construct(QuadroSocietario $_governanca);

    public function get($id);

    public function getQuadroSocietarioPorOSC($_id_osc);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}