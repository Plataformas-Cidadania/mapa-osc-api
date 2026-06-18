<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int nr_convenio
  * @property date dt_ingresso_contrapartida
  * @property double vl_ingresso_contrapartida
 */

 class IngressoContrapartida extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_ingresso_contrapartida';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'dt_ingresso_contrapartida';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['nr_convenio','dt_ingresso_contrapartida','vl_ingresso_contrapartida'];

}
