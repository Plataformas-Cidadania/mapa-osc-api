<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_proponente
  * @property string identif_proponente
  * @property string nm_proponente name,
  * @property string municipio_proponente name,
  * @property char(2) uf_proponente char(2),
  * @property string endereco_proponente name,
  * @property string bairro_proponente name,
  * @property string cep_proponente name,
  * @property string email_proponente name,
  * @property string telefone_proponente name,
  * @property string fax_proponente name, 
 */

 class Proponente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_proponente';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_proponente';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_proponente','identif_proponente','nm_proponente','municipio_proponente','uf_proponente','endereco_proponente','bairro_proponente','cep_proponente','email_proponente','telefone_proponente','fax_proponente'];

}
