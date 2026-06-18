<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Convenio;

interface ConvenioRepositoryInterface
{
    public function __construct(Convenio $_convenio);

    public function get($nr_convenio, $id_proposta, $nr_processo);

    public function getAll();

    public function store(array $data);

    public function update($nr_convenio, $id_proposta, $nr_processo, array $data);

    public function destroy($id);

    public function updateOrCreate(array $data);
}