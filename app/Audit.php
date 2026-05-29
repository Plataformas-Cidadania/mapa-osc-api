<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = [
        'event',
        'entity',
        'entity_id',
        'user_id',
        'old_values',
        'new_values',
        'ip'
    ];
}