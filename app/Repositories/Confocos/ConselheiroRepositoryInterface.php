<?php


namespace App\Repositories\Confocos;


use App\Models\Confocos\Conselheiro;
use Illuminate\Database\Eloquent\Model;

interface ConselheiroRepositoryInterface
{
    public function __construct(Conselheiro $_conselheiro);

    public function getAll();

    public function getPorId($id);

    public function store(array $data);

    public function destroy($id);

    public function update($id_conselho, array $data);

    public function getListaConselheirosPorConselho($id_conselho);

}
