<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int nr_mov_fin
  * @property string identif_favorecido_obtv_conv
  * @property string nm_favorecido_obtv_conv
  * @property string tp_aquisicao
  * @property double vl_pago_obtv_conv
 */

 class ObtvConvenente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_obtv_convenente';

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
    protected $fillable = ['nr_mov_fin','identif_favorecido_obtv_conv','nm_favorecido_obtv_conv','tp_aquisicao','vl_pago_obtv_conv'];

}
