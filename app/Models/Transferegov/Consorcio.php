<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_proposta
  * @property int cnpj_consorcio
  * @property string nome_consorcio
  * @property int codigo_cnae_primario
  * @property string desc_cnae_primario
  * @property int codigo_cnae_secundario
  * @property string desc_cnae_secundario
  * @property string cnpj_participante
  * @property string nome_participante
 */

 class Consorcio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_consorcio';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_proposta';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_proposta','cnpj_consorcio','nome_consorcio','codigo_cnae_primario','desc_cnae_primario','codigo_cnae_secundario','desc_cnae_secundario','cnpj_participante','nome_participante'];

}
