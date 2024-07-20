<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int seq_emenda
  * @property int cod_programa_emenda
  * @property int id_proposta
  * @property string qualif_proponente
  * @property int nr_emenda
  * @property string nome_parlamentar
  * @property int beneficiario_emenda
  * @property char(3) ind_impositivo
  * @property string tipo_parlamentar
  * @property double valor_repasse_proposta_emenda
  * @property double valor_repasse_emenda
 */

 class Emenda extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_emenda';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'seq_emenda';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['cod_programa_emenda','qualif_proponente','id_proposta','nr_emenda','nome_parlamentar','beneficiario_emenda','ind_impositivo','tipo_parlamentar','valor_repasse_proposta_emenda','valor_repasse_emenda'];

}
