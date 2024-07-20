<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\HistoricoSituacao;

interface HistoricoSituacaoRepositoryInterface
{
    public function __construct(HistoricoSituacao $_historico_situacao);

    public function get(int $id_proposta, int $nr_convenio, string $dia_historico_sit);

    public function getAll();

    public function store(array $data);

    public function update(int $id_proposta, int $nr_convenio, string $dia_historico_sit, array $data);

    public function destroy(int $id_proposta, int $nr_convenio, string $dia_historico_sit);

    public function updateOrCreate(array $data);
}