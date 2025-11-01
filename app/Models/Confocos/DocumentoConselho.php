<?php

namespace App\Models\Confocos;

use App\Models\Api\Politica;
use Illuminate\Database\Eloquent\Model;

class DocumentoConselho extends Model
{
    protected $table = 'confocos.tb_documento_conselho';

    /**
     *   @OA\Property(
     *     property="id_documento_conselho",
     *     type="integer",
     *     description="Número de identificação do Documento de Conselho"
     *   )
     *
     * The primary key for the model.
     *
     * @var integer
     */
	protected $primaryKey = 'id_documento_conselho';

    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="tx_titulo_documento",
         *     type="string",
         *     description="Nome do Documento"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_titulo_documento',

        /**
         *   @OA\Property(
         *     property="tx_imagem_capa",
         *     type="string",
         *     description="Nome do Arquivo de Capa da Imagem"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_imagem_capa',

        /**
         *   @OA\Property(
         *     property="tx_caminho_arquivo",
         *     type="string",
         *     description="Caminho do Arquivo (path completo)"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_caminho_arquivo',

        /**
         *   @OA\Property(
         *     property="tx_tipo_arquivo",
         *     type="string",
         *     description="Nome do tipo do arquivo"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_tipo_arquivo',

        /**
         *   @OA\Property(
         *     property="tx_url_externa",
         *     type="string",
         *     description="Url externa do documento"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_url_externa',

        /**
         *   @OA\Property(
         *     property="conselho_id",
         *     type="integer",
         *     description="ID do Conselho que o documento pertence"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'conselho_id'
    ];

    /**
     * @var desativar coluna BD
     */
    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conselho()
    {
        return $this->belongsTo(Conselho::class, 'conselho_id');
    }
}


