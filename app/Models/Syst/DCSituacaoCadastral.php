<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_situacao_cadastral
 * @property string $tx_nome_situacao_cadastral
 */
class DCSituacaoCadastral extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_situacao_cadastral';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_situacao_cadastral';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome_situacao_cadastral'];

}
