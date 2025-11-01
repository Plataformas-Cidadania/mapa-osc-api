<?php

namespace App\Repositories\Confocos;

use App\Models\Confocos\DocumentoConselho;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class DocumentoConselhoRepositoryEloquent implements DocumentoConselhoRepositoryInterface
{
    private $model;

    public function __construct(DocumentoConselho $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($_id)
    {
        $areas_atuacao = $this->model->find($_id);

        return $areas_atuacao;
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
        return $this->model->find($id)->delete();
    }

    public function getListaDocumentosPorConselho($id_conselho)
    {
        $documentos = $this->model->where('id_conselho', $id_conselho)->get();

        return $documentos;
    }

}
