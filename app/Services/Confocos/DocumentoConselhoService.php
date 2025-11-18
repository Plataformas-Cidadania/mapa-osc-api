<?php


namespace App\Services\Confocos;

use App\Repositories\Confocos\DocumentoConselhoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentoConselhoService
{
    private $repo;

    public function __construct(DocumentoConselhoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getPorId($id)
    {
        $documento = $this->repo->get($id);

        $documento['arquivo'] = $this->getArquivoDocumento($documento);

        return $documento;
    }

    public function getListaDocumentosPorConselho($id_conselho)
    {
        return $this->repo->getListaDocumentosPorConselho($id_conselho);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id_conselho)
    {
        return $this->repo->destroy($id_conselho);
    }

    public function uploadDocumento($id_conselho, $file)
    {
        $filename = str_replace(" ", "-", $file->getClientOriginalName());

        $filename = preg_replace("/[^A-Za-z0-9-.]/","", $filename);

        $filenameRandom = rand(1,10000)."-".$id_conselho."-".$filename;

        $this->successFile = Storage::putFileAs("/confocos/", $file, $filenameRandom);

        if ( $this->successFile ) {

            $data = [
                'id_conselho' => $id_conselho,
                'tx_titulo_documento' => $filenameRandom,
                'tx_caminho_arquivo' => str_replace("//", "/", $this->successFile),
                'tx_tipo_arquivo' => $file->getClientMimeType(),
                'dt_data_cadastro' => date('Y-m-d H:i:s'),
            ];

            $novo_documento =  $this->repo->store($data);

            $novo_documento['arquivo'] = $this->getArquivoDocumento($novo_documento);

            return $novo_documento;
        }
    }

    public function getArquivoDocumento($documento) {

        $arquivo = base64_encode(file_get_contents(storage_path('app/'. $documento->tx_caminho_arquivo)));

        return $arquivo;
    }
}
