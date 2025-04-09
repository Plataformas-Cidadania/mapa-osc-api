<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_termo
 * @property string $tx_nome
 */
class Termo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_termo';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_termo';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome'];

    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assinaturas()
    {
        return $this->belongsTo('App\Models\Portal\AssinaturaTermo', 'id_termo', 'id_termo');
    }
}
