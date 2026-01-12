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
    private $empenhoDesembolsoService;
    private $proponenteService;

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
            ConsorcioService $consorcioService,
            EmpenhoDesembolsoService $empenhoDesembolsoService,
            ProponenteService $proponenteService
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
        $this->empenhoDesembolsoService = $empenhoDesembolsoService;
        $this->proponenteService = $proponenteService;
    }

    public function whichService($table, $data)
    {
        switch ($table) {
            case 'programa':
                $this->programaService->updateOrCreate($data);
                break;
            
            case 'programa_proposta':
                $this->programaPropostaService->updateOrCreate($data);
                break;
            
            case 'proposta':
                $this->propostaService->updateOrCreate($data);
                break;
            
            case 'convenio':
                $this->convenioService->updateOrCreate($data);
                break;

            case 'emenda':
                $this->emendaService->updateOrCreate($data);
                break;

            case 'plano':
                $this->planoService->updateOrCreate($data);
                break;

            case 'empenho':
                $this->empenhoService->updateOrCreate($data);
                break;

            case 'desembolso':
                $this->desembolsoService->updateOrCreate($data);
                break;

            case 'pagamento':
                $this->pagamentoService->updateOrCreate($data);
                break;
            
            case 'obtvConvenente':
                $this->obtvConvenenteService->updateOrCreate($data);
                break;

            case 'historicoSituacao':
                $this->historicoSituacaoService->updateOrCreate($data);
                break;

            case 'ingressoContrapartida':
                $this->ingressoContrapartidaService->updateOrCreate($data);
                break;

            case 'termoAditivo':
                $this->termoAditivoService->updateOrCreate($data);
                break;
            
            case 'prorroga':
                $this->prorrogaService->updateOrCreate($data);
                break;

            case 'meta':
                $this->metaService->updateOrCreate($data);
                break;

            case 'etapa':
                $this->etapaService->updateOrCreate($data);
                break;

            case 'consorcio':
                $this->consorcioService->updateOrCreate($data);
                break;

            case 'empenhoDesembolso':
                $this->empenhoDesembolsoService->updateOrCreate($data);
                break;

            case 'proponente':
                $this->proponenteService->updateOrCreate($data);
                break;
                
            default:
                throw new Exception("Error Processing Request", 1);                    
                break;
        }
    }
}