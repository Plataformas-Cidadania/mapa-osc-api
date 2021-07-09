<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIndice;
use Illuminate\Database\Eloquent\Model;

interface DCIndiceRepositoryInterface
{
    public function __construct(DCIndice $_modelo);

    public function getAll();

    public function get($_id);
}