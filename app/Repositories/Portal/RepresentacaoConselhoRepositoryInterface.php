<?php


namespace App\Repositories\Portal;

use App\Models\Portal\RepresentacaoConselho;
use Illuminate\Database\Eloquent\Model;

interface RepresentacaoConselhoRepositoryInterface
{
    public function __construct(RepresentacaoConselho $_representacao);

    public function getAll();

    public function get($id);

    public function getRepresetacaoPorConselhoAndUsuario($id_conselho, $id_usuario);

    public function store(array $data);

    public function destroy($id);
}
