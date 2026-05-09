<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Consorcio;

interface ConsorcioRepositoryInterface
{
    public function __construct(Consorcio $_consorcio);

    public function get(int $id_proposta, int $cnpj_consorcio, int $codigo_cnae_secundario);

    public function getAll();

    public function store(array $data);

    public function update(int $id_proposta, int $cnpj_consorcio, int $codigo_cnae_secundario, array $data);

    public function destroy(int $id_proposta, int $cnpj_consorcio, int $codigo_cnae_secundario);

    public function updateOrCreate(array $data);
}