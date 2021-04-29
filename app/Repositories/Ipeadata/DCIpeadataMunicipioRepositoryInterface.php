<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIpeadataUff;
use Illuminate\Database\Eloquent\Model;

interface DCIpeadataUffRepositoryInterface
{
    public function __construct(DCIpeadataUff $_modelo);

    public function getAll();

    public function get($_id);
}