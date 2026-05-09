<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_proposta
  * @property int id_item_pad
  * @property int cod_natureza_despesa
  * @property char(2) sigla
  * @property string municipio
  * @property int natureza_aquisicao
  * @property string descricao_item
  * @property string cep_item
  * @property string endereco_item
  * @property string tipo_despesa_item
  * @property string natureza_despesa
  * @property string sit_item
  * @property double qtd_item
  * @property double valor_unitario_item
  * @property double valor_total_item
 */

 class Plano extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_plano';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'cod_natureza_despesa';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_proposta','sigla','municipio','natureza_aquisicao','descricao_item','cep_item','endereco_item','tipo_despesa_item','natureza_despesa','sit_item','cod_natureza_despesa','qtd_item','valor_unitario_item','valor_total_item','id_item_pad'];

}
