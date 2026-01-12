<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_proposta
  * @property int nr_convenio
  * @property string dia_historico_sit
  * @property string historico_sit
  * @property int dias_historico_sit
  * @property int cod_historico_sit
 */

 class HistoricoSituacao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_historico_situacao';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'dia_historico_sit';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_proposta','nr_convenio','dia_historico_sit','historico_sit','dias_historico_sit','cod_historico_sit'];

}
