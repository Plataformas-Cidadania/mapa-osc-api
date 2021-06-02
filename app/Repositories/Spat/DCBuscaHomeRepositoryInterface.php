<?php


namespace App\Repositories\Spat;

use Illuminate\Database\Eloquent\Model;

interface DCBuscaHomeRepositoryInterface
{
    public function __construct();

    public function getListaMunicipios($texto_busca);
    public function getListaEstados($texto_busca);
    public function getListaRegioes($texto_busca);
}