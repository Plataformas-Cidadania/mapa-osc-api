<?php

namespace App\Providers;

use App\Repositories\Ipeadata\DCIpeadataUffRepositoryInterface;
use App\Repositories\Osc\FonteRecursosProjetoRepositoryInterface;
use App\Repositories\Osc\ObjetivoOscRepositoryInterface;
use App\Repositories\Portal\BuscaAvancadaRepositoryInterface;
use App\Repositories\Spat\DCBuscaHomeRepositoryInterface;
use App\Repositories\Spat\DCGeoClusterRepositoryInterface;
use App\Repositories\Syst\DCClasseAtividadeEconomicaRepositoryInterface;
use App\Repositories\Syst\DCConferenciaRepositoryInterface;
use App\Repositories\Syst\DCFormaParticipacaoConferenciaRepositoryInterface;
use App\Repositories\Syst\DCMetaProjetoRepositoryInterface;
use App\Repositories\Syst\DCPeriodicidadeReuniaoConselhoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Mapeamento das Interfaces para Classes Concretas
        $this->app->bind(
            'App\Repositories\Portal\BuscaAvancadaRepositoryInterface', 'App\Repositories\Portal\BuscaAvancadaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Portal\RepresentacaoRepositoryInterface', 'App\Repositories\Portal\RepresentacaoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Portal\UsuarioRepositoryInterface', 'App\Repositories\Portal\UsuarioRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\OscRepositoryInterface', 'App\Repositories\Osc\OscRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Portal\BarratransparenciaRepositoryInterface', 'App\Repositories\Portal\BarratransparenciaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\DadosGeraisRepositoryInterface', 'App\Repositories\Osc\DadosGeraisRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\AreaAtuacaoRepositoryInterface', 'App\Repositories\Osc\AreaAtuacaoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\AreaAtuacaoRepresentanteRepositoryInterface', 'App\Repositories\Osc\AreaAtuacaoRepresentanteRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\CertificadoRepositoryInterface', 'App\Repositories\Osc\CertificadoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ObjetivoOscRepositoryInterface', 'App\Repositories\Osc\ObjetivoOscRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ProjetoRepositoryInterface', 'App\Repositories\Osc\ProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\RecursosOSCRepositoryInterface', 'App\Repositories\Osc\RecursosOSCRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\SemRecursosOSCRepositoryInterface', 'App\Repositories\Osc\SemRecursosOSCRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\RelacoesTrabalhoRepositoryInterface', 'App\Repositories\Osc\RelacoesTrabalhoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\GovernancaRepositoryInterface', 'App\Repositories\Osc\GovernancaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ConselhoFiscalRepositoryInterface', 'App\Repositories\Osc\ConselhoFiscalRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ParticipacaoSocialConselhoRepositoryInterface', 'App\Repositories\Osc\ParticipacaoSocialConselhoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ParticipacaoSocialConferenciaRepositoryInterface', 'App\Repositories\Osc\ParticipacaoSocialConferenciaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ParticipacaoSocialOutraRepositoryInterface', 'App\Repositories\Osc\ParticipacaoSocialOutraRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\OscParceiraProjetoRepositoryInterface', 'App\Repositories\Osc\OscParceiraProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\TipoParceriaProjetoRepositoryInterface', 'App\Repositories\Osc\TipoParceriaProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\LocalizacaoProjetoRepositoryInterface', 'App\Repositories\Osc\LocalizacaoProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\FinanciadorProjetoRepositoryInterface', 'App\Repositories\Osc\FinanciadorProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\ObjetivoProjetoRepositoryInterface', 'App\Repositories\Osc\ObjetivoProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\PublicoBeneficiadoProjetoRepositoryInterface', 'App\Repositories\Osc\PublicoBeneficiadoProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\FonteRecursosProjetoRepositoryInterface', 'App\Repositories\Osc\FonteRecursosProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Osc\DCListaOSCsRegiaoRepositoryInterface', 'App\Repositories\Osc\DCListaOSCsRegiaoRepositoryEloquent'
        );

        //DADOS DO SCHEMA SYST
        $this->app->bind(
            'App\Repositories\Syst\DCAreaAtuacaoRepositoryInterface', 'App\Repositories\Syst\DCAreaAtuacaoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCSubAreaAtuacaoRepositoryInterface', 'App\Repositories\Syst\DCSubAreaAtuacaoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCMetaProjetoRepositoryInterface', 'App\Repositories\Syst\DCMetaProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCObjetivoProjetoRepositoryInterface', 'App\Repositories\Syst\DCObjetivoProjetoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCConselhoRepositoryInterface', 'App\Repositories\Syst\DCConselhoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCConferenciaRepositoryInterface', 'App\Repositories\Syst\DCConferenciaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCPeriodicidadeReuniaoConselhoRepositoryInterface', 'App\Repositories\Syst\DCPeriodicidadeReuniaoConselhoRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCFormaParticipacaoConferenciaRepositoryInterface', 'App\Repositories\Syst\DCFormaParticipacaoConferenciaRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Syst\DCClasseAtividadeEconomicaRepositoryInterface', 'App\Repositories\Syst\DCClasseAtividadeEconomicaRepositoryEloquent'
        );

        //DADOS DO SCHEMA SPAT
        $this->app->bind(
            'App\Repositories\Spat\DCGeoClusterRepositoryInterface', 'App\Repositories\Spat\DCGeoClusterRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Spat\DCBuscaHomeRepositoryInterface', 'App\Repositories\Spat\DCBuscaHomeRepositoryEloquent'
        );

        //DADOS DO SCHEMA IPEADATA
        $this->app->bind(
            'App\Repositories\Ipeadata\DCIpeadataUffRepositoryInterface', 'App\Repositories\Ipeadata\DCIpeadataUffRepositoryEloquent'
        );
        $this->app->bind(
            'App\Repositories\Ipeadata\DCIpeadataMunicipioRepositoryInterface', 'App\Repositories\Ipeadata\DCIpeadataMunicipioRepositoryEloquent'
        );

        //DADOS DO SCHEMA ANALISYS
        $this->app->bind(
            'App\Repositories\Analisys\DCPerfilLocalidadeRepositoryInterface', 'App\Repositories\Analisys\DCPerfilLocalidadeRepositoryEloquent'
        );
    }
}
