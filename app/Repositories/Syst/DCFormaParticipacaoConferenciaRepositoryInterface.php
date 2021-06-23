<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCFormaParticipacaoConferencia;
use Illuminate\Database\Eloquent\Model;

interface DCFormaParticipacaoConferenciaRepositoryInterface
{
    public function __construct(DCFormaParticipacaoConferencia $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}