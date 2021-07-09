<?php

namespace App\Models\Ipeadata;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_indice
 * @property string $tx_nome_indice
 * @property string $tx_sigla
 * @property string $tx_tema
 * @property IpeaData[] $ipea_datas
 * @property DCIpeadataUff[] $ipea_datas_uff
 */
class DCIndice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ipeadata.tb_indice';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_indice';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome_indice', 'tx_sigla', 'tx_tema'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipea_datas()
    {
        return $this->hasMany('App\Models\IpeaData\IpeaData', 'cd_indice', 'cd_indice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipea_data_ufs()
    {
        return $this->hasMany('App\Models\IpeaData\DCIpeadataUff', 'cd_indice', 'cd_indice');
    }
}
