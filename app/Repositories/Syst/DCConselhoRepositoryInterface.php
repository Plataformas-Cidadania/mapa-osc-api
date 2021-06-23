<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCConselho;
use Illuminate\Database\Eloquent\Model;

interface DCConselhoRepositoryInterface
{
    public function __construct(DCConselho $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}