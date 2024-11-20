<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_meta
  * @property int id_proposta
  * @property int nr_convenio
  * @property int cod_programa
  * @property int nome_programa
  * @property int nr_meta
  * @property string tipo_meta
  * @property string desc_meta
  * @property date data_inicio_meta
  * @property date data_fim_meta
  * @property char(2) uf_meta
  * @property string municipio_meta
  * @property string endereco_meta
  * @property string cep_meta
  * @property double qtd_meta
  * @property string und_fornecimento_meta
  * @property double vl_meta
 */

 class Meta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_meta';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_meta';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_meta','id_proposta','nr_convenio','cod_programa','nome_programa','nr_meta','tipo_meta','desc_meta','data_inicio_meta','data_fim_meta','uf_meta','municipio_meta','endereco_meta','cep_meta','qtd_meta','und_fornecimento_meta','vl_meta'];

}
