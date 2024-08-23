<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int nr_mov_fin
  * @property int nr_convenio
  * @property string identif_fornecedor
  * @property string nome_fornecedor
  * @property string tp_mov_financeira
  * @property string data_pag
  * @property string nr_dl
  * @property string desc_dl
  * @property string ug_emitente_dh
  * @property string observacao_dh
  * @property double vl_pago
 */

 class Pagamento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_pagamento';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'nr_mov_fin';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['nr_mov_fin','nr_convenio','identif_fornecedor','nome_fornecedor','tp_mov_financeira','data_pag','nr_dl','desc_dl','vl_pago'];

}
