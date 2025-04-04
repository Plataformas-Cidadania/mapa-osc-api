<?php


namespace App\Repositories\Syst;


use App\Models\Syst\DCSituacaoCadastral;
use Illuminate\Database\Eloquent\Model;

interface DCSituacaoCadastralRepositoryInterface
{
    public function __construct(DCSituacaoCadastral $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}