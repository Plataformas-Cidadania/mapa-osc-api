<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_empenho
  * @property int nr_convenio
  * @property int nr_empenho
  * @property int tipo_nota
  * @property string desc_tipo_nota
  * @property string data_emissao
  * @property string cod_situacao_empenho
  * @property string desc_situacao_empenho
  * @property int ug_emitente
  * @property int ug_responsavel
  * @property string fonte_recurso
  * @property string natureza_despesa
  * @property string plano_interno
  * @property int ptres
  * @property double valor_empenho
 */

 class Empenho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_empenho';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_empenho';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_empenho','nr_convenio','nr_empenho','tipo_nota','desc_tipo_nota','data_emissao','cod_situacao_empenho','desc_situacao_empenho','ug_emitente','ug_responsavel','fonte_recurso','natureza_despesa','plano_interno','ptres','valor_empenho'];

}
