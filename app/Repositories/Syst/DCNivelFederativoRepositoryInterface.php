<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCNivelFederativo;
use Illuminate\Database\Eloquent\Model;

interface DCNivelFederativoRepositoryInterface
{
    public function __construct(DCNivelFederativo $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}