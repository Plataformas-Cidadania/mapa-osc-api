<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_assinatura
 * @property int $id_representacao
 * @property int $id_termo
 * @property Portal.tbRepresentacao $portal.tbRepresentacao
 * @property Portal.tbTermos $portal.tbTermos
 */
class AssinaturaTermo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_assinatura_termo';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_assinatura';

    /**
     * @var array
     */
    protected $fillable = ['id_representacao', 'id_termo'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function representacao()
    {
        return $this->belongsTo('App\Models\Portal\Representacao', 'id_representacao', 'id_representacao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function termo()
    {
        return $this->belongsTo('App\Models\Portal\Termo', 'id_termo', 'id_termo');
    }
}
