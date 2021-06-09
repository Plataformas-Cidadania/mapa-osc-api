<?php


namespace App\Repositories\Osc;

use Illuminate\Database\Eloquent\Model;

interface DCListaOSCsRegiaoRepositoryInterface
{
    public function __construct();

    public function getListaOSCsMunicipio($id_localidade, $pagina);

    public function getListaOSCsEstado($id_localidade, $pagina);

    public function getListaOSCsRegiao($id_localidade, $pagina);
}