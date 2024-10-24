<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCTipoSocio;
use Illuminate\Database\Eloquent\Model;

interface DCTipoSocioRepositoryInterface
{
    public function __construct(DCTipoSocio $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}