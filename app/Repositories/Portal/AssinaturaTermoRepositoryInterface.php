<?php


namespace App\Repositories\Portal;

use App\Models\Portal\AssinaturaTermo;

interface AssinaturaTermoRepositoryInterface
{
    public function __construct(AssinaturaTermo $_assinatura_termo);

    public function getAll();

    public function get($id);

    public function getPorRepresentacaoAndTermo($id_representacao, $id_termo);

    public function store(array $data);

    public function destroy($id);
}
