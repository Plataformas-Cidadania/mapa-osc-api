<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIndice;
use App\Repositories\Ipeadata\DCIndiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCIndiceRepositoryEloquent implements DCIndiceRepositoryInterface
{
    private $model;

    public function __construct(DCIndice $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($_id)
    {
        $meta = $this->model->find($_id);

        return $meta;
    }
}