<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_projeto
 * @property int $id_publico_beneficiado_projeto
 * @property string $ft_estimativa_pessoas_atendidas
 * @property int $nr_estimativa_pessoas_atendidas
 * @property boolean $bo_oficial
 * @property string $tx_nome_publico_beneficiado
 * @property string $ft_nome_publico_beneficiado
 * @property Projeto $projeto
 */
class PublicoBeneficiadoProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_publico_beneficiado_projeto';

    protected $primaryKey = 'id_publico_beneficiado_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        'id_projeto',
        'id_publico_beneficiado_projeto',
        'ft_estimativa_pessoas_atendidas',
        'nr_estimativa_pessoas_atendidas',
        'bo_oficial',
        'tx_nome_publico_beneficiado',
        'ft_nome_publico_beneficiado'
    ];

    protected $attributes = [
        'ft_estimativa_pessoas_atendidas' => 'Representante de OSC',
        'ft_nome_publico_beneficiado' => 'Representante de OSC'
    ];

    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Projeto()
    {
        return $this->belongsTo('App\Models\Osc\Projeto', 'id_projeto', 'id_projeto');
    }
}
