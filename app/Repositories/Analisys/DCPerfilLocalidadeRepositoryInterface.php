<?php


namespace App\Repositories\Analisys;

use Illuminate\Database\Eloquent\Model;

interface DCPerfilLocalidadeRepositoryInterface
{
    public function __construct();

    public function getAll();

    public function getEvolucaoQtdOscPorAno($id_localidade);

    public function getCaracteristicas($id_localidade);

    public function getQtdNaturezaJuridica($id_localidade);

    public function getTransferenciasFederais($id_localidade);
}