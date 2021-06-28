<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Usuario;
use Illuminate\Database\Eloquent\Model;

class UsuarioRepositoryEloquent implements UsuarioRepositoryInterface
{
    private $model;

    public function __construct(Usuario $_usuario)
    {
        $this->model = $_usuario;
    }

    public function getAll()
    {
        return $this->model->with('osc')->with('usuario')->get();//->whereIn('id_usuario', [1, 250, 251]);//->orderBy('id_usuario', 'asc');
    }

    public function get($id)
    {
        return $this->model->with('usuario')->with('osc')->where('id_usuario', $id)->get();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find(id)->delete();
    }
}
