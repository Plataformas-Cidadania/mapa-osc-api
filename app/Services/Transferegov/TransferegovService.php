<?php
namespace App\Services\Transferegov;

use Exception;

class TransferegovService
{
    private $programaService;
    private $programaPropostaService;
    private $propostaService;
    private $convenioService;
    private $emendaService;
    private $planoService;
    private $empenhoService;
    private $desembolsoService;
    private $pagamentoService;
    private $obtvConvenenteService;
    private $historicoSituacaoService;
    private $ingressoContrapartidaService;
    private $termoAditivoService;
    private $prorrogaService;
    private $metaService;
    private $etapaService;
    private $consorcioService;

    public function __construct(
            ProgramaService $programaService,
            ProgramaPropostaService $programaPropostaService,
            PropostaService $propostaService,
            ConvenioService $convenioService,
            EmendaService $emendaService,
            PlanoService $planoService,
            EmpenhoService $empenhoService,
            DesembolsoService $desembolsoService,
            PagamentoService $pagamentoService,
            ObtvConvenenteService $obtvConvenenteService,
            HistoricoSituacaoService $historicoSituacaoService,
            IngressoContrapartidaService $ingressoContrapartidaService,
            TermoAditivoService $termoAditivoService,
            ProrrogaService $prorrogaService,
            MetaService $metaService,
            EtapaService $etapaService,
            ConsorcioService $consorcioService
        )
    {
        $this->programaService = $programaService;
        $this->programaPropostaService = $programaPropostaService;
        $this->propostaService = $propostaService;
        $this->convenioService = $convenioService;
        $this->emendaService = $emendaService;
        $this->planoService = $planoService;
        $this->empenhoService = $empenhoService;
        $this->desembolsoService = $desembolsoService;
        $this->pagamentoService = $pagamentoService;
        $this->obtvConvenenteService = $obtvConvenenteService;
        $this->historicoSituacaoService = $historicoSituacaoService;
        $this->ingressoContrapartidaService = $ingressoContrapartidaService;
        $this->termoAditivoService = $termoAditivoService;
        $this->prorrogaService = $prorrogaService;
        $this->metaService = $metaService;
        $this->etapaService = $etapaService;
        $this->consorcioService = $consorcioService;
    }

    public function whichService($table, $data)
    {
        switch ($table) {
            case 'programa':
                $this->programaService->store($data);
                break;
            
            case 'programa_proposta':
                $this->programaPropostaService->store($data);
                break;
            
            case 'proposta':
                $this->propostaService->store($data);
                break;
            
            case 'convenio':
                $this->convenioService->updateOrCreate($data);
                break;

            case 'emenda':
                $this->emendaService->store($data);
                break;

            case 'plano':
                var_dump($data);die;
                $this->planoService->store($data);
                break;

            case 'empenho':
                $this->empenhoService->store($data);
                break;

            case 'desembolso':
                $this->desembolsoService->store($data);
                break;

            case 'pagamento':
                $this->pagamentoService->store($data);
                break;
            
            case 'obtvConvenente':
                $this->obtvConvenenteService->store($data);
                break;

            case 'historicoSituacao':
                $this->historicoSituacaoService->store($data);
                break;

            case 'ingressoContrapartida':
                $this->ingressoContrapartidaService->store($data);
                break;

            case 'termoAditivo':
                $this->termoAditivoService->store($data);
                break;
            
            case 'prorroga':
                $this->prorrogaService->store($data);
                break;

            case 'meta':
                $this->metaService->store($data);
                break;

            case 'etapa':
                $this->etapaService->store($data);
                break;

            case 'consorcio':
                $this->consorcioService->store($data);
                break;
            default:
                throw new Exception("Error Processing Request", 1);                    
                break;
        }
    }
}