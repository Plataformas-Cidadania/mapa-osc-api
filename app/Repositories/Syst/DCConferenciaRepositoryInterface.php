<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCConferencia;
use Illuminate\Database\Eloquent\Model;

interface DCConferenciaRepositoryInterface
{
    public function __construct(DCConferencia $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}