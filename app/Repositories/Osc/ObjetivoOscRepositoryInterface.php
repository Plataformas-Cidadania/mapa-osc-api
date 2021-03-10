<?php


namespace App\Repositories\Osc;


use App\Models\Osc\ObjetivoOsc;
use Illuminate\Database\Eloquent\Model;

interface ObjetivoOscRepositoryInterface
{
    public function __construct(ObjetivoOsc $_objetivo);

    public function get($id);

    public function getObjetivosPorOsc($_id_osc);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}