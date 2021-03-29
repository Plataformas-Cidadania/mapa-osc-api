<?php


namespace App\Repositories\Osc;


use App\Models\Osc\Osc;
use Illuminate\Database\Eloquent\Model;

interface OscRepositoryInterface
{
    public function __construct(Osc $_osc);

    public function getAll();

    public function get($id);

    public function getNumeroTotalOSCs();

    public function getCabecalho($id);

    public function getDadosGerais($id);


    public function getListaOscAtualizadas($tam_lista);

    public function updateLogo($id, array $data);


    public function updateDadosGerais($id, array $data);

    public function getRelTrabalhoAndGovernanca($id);

    public function getProjetos($id);

    public function getParticipacaoSocial($id);

    public function update($id, array $data);

    public function getGrafico($tipo_graf);
}
