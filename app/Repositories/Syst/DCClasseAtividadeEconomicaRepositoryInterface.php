<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCClasseAtividadeEconomica;
use Illuminate\Database\Eloquent\Model;

interface DCClasseAtividadeEconomicaRepositoryInterface
{
    public function __construct(DCClasseAtividadeEconomica $_modelo);

    public function getAll();

    public function get($_id);

    public function getAutocomplete($_param);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}