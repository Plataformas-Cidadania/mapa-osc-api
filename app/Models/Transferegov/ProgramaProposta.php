<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int $id_programa
  * @property int $id_proposta
 */

 class ProgramaProposta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_programa_proposta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_programa';

    /**
     * @var array
     */
    protected $fillable = ['id_programa','id_proposta'];

    public $timestamps = true;
}
