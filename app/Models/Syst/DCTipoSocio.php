<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_status_projeto
 * @property string $tx_nome_status_projeto
 * @property Osc.tbQuadroSocietario[] $osc.tbQuadrosSocietarios
 */
class DCTipoSocio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_tipo_socio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_tipo_socio';

    /**
     * @var array
     */
    protected $fillable = ['tx_tipo_socio'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quadros_societarios()
    {
        return $this->hasMany('App\Models\Osc\QuadroSocietario', 'cd_tipo_socio', 'cd_tipo_socio');
    }
}