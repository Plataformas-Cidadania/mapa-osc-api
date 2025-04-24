<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Representacao;
use Illuminate\Database\Eloquent\Model;

interface RepresentacaoRepositoryInterface
{
    public function __construct(Representacao $_representacao);

    public function getAll();

    public function get($id);

    public function getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}
