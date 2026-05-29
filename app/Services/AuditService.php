<?php

namespace App\Services;

use App\Audit;

class AuditService
{

    public function __construct(){

    }

    public function auditar($event, $entity, $entity_id, $user_id, $old_values, $new_values, $ip)
    {
        Audit::create([
            'event' => $event,
            'entity' => $entity,
            'entity_id' => $entity_id,
            'user_id' => $user_id,
            'old_values' => json_encode($old_values),
            'new_values' => json_encode($new_values),
            'ip' => $ip
        ]);
    }
}