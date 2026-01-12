<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_etapa
  * @property int id_meta
  * @property int nr_etapa
  * @property string desc_etapa
  * @property date data_inicio_etapa
  * @property date data_fim_etapa
  * @property char(2) uf_etapa
  * @property string municipio_etapa
  * @property string endereco_etapa
  * @property string cep_etapa
  * @property double qtd_etapa
  * @property string und_fornecimento_etapa
  * @property double vl_etapa
 */

 class Etapa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_etapa';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_etapa';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_etapa','id_meta','nr_etapa','desc_etapa','data_inicio_etapa','data_fim_etapa','uf_etapa','municipio_etapa','endereco_etapa','cep_etapa','qtd_etapa','und_fornecimento_etapa','vl_etapa'];

}
