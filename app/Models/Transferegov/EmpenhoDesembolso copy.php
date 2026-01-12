<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_desembolso
  * @property int id_empenho
  * @property double valor_grupo
 */

 class EmpenhoDesembolso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_empenho_desembolso';

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
    protected $fillable = ['id_desembolso','id_empenho','valor_grupo'];

}
