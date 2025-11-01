<?php


namespace App\Repositories\Confocos;

use App\Models\Confocos\DocumentoConselho;

interface DocumentoConselhoRepositoryInterface
{
    public function __construct(DocumentoConselho $_modelo);

    public function getAll();

    public function get($_id);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);

    public function getListaDocumentosPorConselho($id_conselho);
}