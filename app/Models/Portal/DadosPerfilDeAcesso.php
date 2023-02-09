<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DadosPerfilDeAcesso
 *
 * @package App
 *
 * @property int $id
 * @property string $tipo_perfil
 * @property string $endereco_ip
 */
class DadosPerfilDeAcesso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_dados_perfil_de_acesso';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var array
     */
    protected $fillable = ['tipo_perfil','endereco_ip'];

}
