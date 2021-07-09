<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCTipoParticipacao;
use Illuminate\Database\Eloquent\Model;

interface DCTipoParticipacaoRepositoryInterface
{
    public function __construct(DCTipoParticipacao $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}