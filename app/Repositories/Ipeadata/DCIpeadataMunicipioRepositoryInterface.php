<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIpeadataMunicipio;
use Illuminate\Database\Eloquent\Model;

interface DCIpeadataMunicipioRepositoryInterface
{
    public function __construct(DCIpeadataMunicipio $_modelo);

    public function getAll();

    public function get($_id);
}