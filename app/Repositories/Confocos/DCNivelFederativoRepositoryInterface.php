<?php


namespace App\Repositories\Confocos;


use App\Models\Confocos\DCNivelFederativo;

interface DCNivelFederativoRepositoryInterface
{
    public function __construct(DCNivelFederativo $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}