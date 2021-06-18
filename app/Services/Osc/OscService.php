<?php


namespace App\Services\Osc;

use App\Models\Portal\Usuario;
use App\Repositories\Osc\OscRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OscService
{
    private $repo;

    public function __construct(OscRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getNumeroTotalOSCs()
    {
        return $this->repo->getNumeroTotalOSCs();
    }

    public function getCabecalho($id)
    {
        return $this->repo->getCabecalho($id);
    }

    public function getDadosGerais($id)
    {
        return $this->repo->getDadosGerais($id);
    }

    public function updateDadosGerais($id, $data)
    {
        return $this->repo->updateDadosGerais($id, $data);
    }

    public function updateLogo($id, $file)
    {
        $filename = str_replace(" ", "-", $file->getClientOriginalName());
        $filename = preg_replace("/[^A-Za-z0-9-.]/","", $filename);
        $filenameRandom = rand(1,10000)."-".$id."-".$filename;
        $this->successFile = Storage::putFileAs("/osc/", $file, $filenameRandom);
        $this->repo->updateLogo($id, ['im_logo' => $filenameRandom, 'ft_logo' => "Representante de OSC"]);
        return 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/osc/'.$filenameRandom)));
    }

    public function getLogo($id){
        $logo = $this->repo->getLogo($id);
        if($logo === false){
            return null;
        }
        return 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/osc/'.$logo)));
    }

    public function getRelTrabalhoAndGovernanca($id)
    {
        return $this->repo->getRelTrabalhoAndGovernanca($id);
    }

    public function getProjetos($id)
    {
        return $this->repo->getProjetos($id);
    }

    public function getParticipacaoSocial($id)
    {
        return $this->repo->getParticipacaoSocial($id);
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function getListaOscAtualizadas($tam_lista)
    {
        return $this->repo->getListaOscAtualizadas($tam_lista);
    }

    public function getGrafico($tipo_graf)
    {
        return $this->repo->getGrafico($tipo_graf);
    }

    public function getListaOscAreaAtuacaoAndMunicipio($areaAtuacao, $municipio, $limit)
    {
        return $this->repo->getListaOscAreaAtuacaoAndMunicipio($areaAtuacao, $municipio, $limit);
    }

    public function getPopupOSC($id_osc)
    {
        return $this->repo->getPopupOSC($id_osc);
    }

    public function getListaOscUsuarioAutenticado(){
        $oscs = Auth::user()->oscs;
        $idsOscs = [];
        foreach ($oscs as $osc) {
            array_push($idsOscs, $osc->id_osc);
        }
        return $this->repo->getListaOscsPorIds($idsOscs);
    }

    public function getListaOscCnpjAutocomplete($cnpj){
        return $this->repo->getListaOscCnpjAutocomplete($cnpj);
    }
}
