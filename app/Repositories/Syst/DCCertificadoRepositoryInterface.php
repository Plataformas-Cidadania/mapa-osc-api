<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCCertificado;
use Illuminate\Database\Eloquent\Model;

interface DCCertificadoRepositoryInterface
{
    public function __construct(DCCertificado $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}