<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Plano;

interface PlanoRepositoryInterface
{
    public function __construct(Plano $_plano);

    public function get(int $id_proposta, int $id_item_pad, int $cod_natureza_despesa);

    public function getAll();

    public function store(array $data);

    public function update(int $id_proposta, int $id_item_pad, int $cod_natureza_despesa, array $data);

    public function destroy(int $id_proposta, int $id_item_pad, int $cod_natureza_despesa);

    public function updateOrCreate(array $data);
}