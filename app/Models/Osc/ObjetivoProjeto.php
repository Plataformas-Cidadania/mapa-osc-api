<?php

namespace App\Models\Osc;

use App\Models\Syst\DCMetaProjeto;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_objetivo_projeto
 * @property int $id_projeto
 * @property int $cd_meta_projeto
 * @property string $ft_objetivo_projeto
 * @property boolean $bo_oficial
 * @property Projeto $projeto
 * @property DCMetaProjeto $meta_projeto
 */
class ObjetivoProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_objetivo_projeto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_objetivo_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        'id_projeto',
        'cd_meta_projeto',
        'ft_objetivo_projeto',
        'bo_oficial'
    ];

    protected $attributes = [
        'ft_objetivo_projeto' => 'Representante de OSC'
    ];

    public $timestamps = false;

    protected $with = ['meta_projeto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Projeto()
    {
        return $this->belongsTo('App\Models\Osc\Projeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meta_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCMetaProjeto', 'cd_meta_projeto', 'cd_meta_projeto');
    }
}
