<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Termo;
use Illuminate\Database\Eloquent\Model;

interface TermoRepositoryInterface
{
    public function __construct(Termo $termo);

    public function getAll();

    public function get($id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}
