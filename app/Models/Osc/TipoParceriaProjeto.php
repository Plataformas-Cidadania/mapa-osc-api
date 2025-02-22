<?php

namespace App\Models\Osc;

use App\Models\Syst\DCTipoParceria;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tipo_parceria_projeto
 * @property int $id_projeto
 * @property int $cd_tipo_parceria_projeto
 * @property int $id_fonte_recursos_projeto
 * @property string $ft_tipo_parceria_projeto
 * @property Projeto $projeto
 * @property DCTipoParceria $dc_tipo_parceria_projeto
 * @property FonteRecursosProjeto $fonte_recursos_projeto
 */
class TipoParceriaProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_tipo_parceria_projeto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_parceria_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        'id_projeto',
        'cd_tipo_parceria_projeto',
        'id_fonte_recursos_projeto',
        'ft_tipo_parceria_projeto'
    ];

    protected $attributes = [
        'ft_tipo_parceria_projeto' => 'Representante de OSC'
    ];

    public $timestamps = false;

    protected $with = [
        'dc_tipo_parceria'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projeto()
    {
        return $this->belongsTo('App\Models\Osc\Projeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_tipo_parceria()
    {
        return $this->belongsTo('App\Models\Syst\DCTipoParceria', 'cd_tipo_parceria_projeto', 'cd_tipo_parceria');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fonte_recursos_projeto()
    {
        return $this->belongsTo('App\Models\Osc\FonteRecursosProjeto', 'id_fonte_recursos_projeto', 'id_fonte_recursos_projeto');
    }
}
