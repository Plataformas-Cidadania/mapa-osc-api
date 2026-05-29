<?php

namespace App\Observers;

use App\Audit;
use App\Models\Osc\Osc;
use Illuminate\Support\Facades\Auth;

class OscObserver
{
    public function updated(Osc $osc)
    {
        $usuario = Auth::user();

        Audit::create([

            'event' => 'updated',

            'entity' => 'osc',

            'entity_id' => $osc->id_osc,

            'user_id' => $usuario ? $usuario->id_usuario : null,

            'old_values' => json_encode(
                $osc->getOriginal()
            ),

            'new_values' => json_encode(
                $osc->getChanges()
            ),

            'ip' => request()->ip()
        ]);

        \Log::info('Observer updated disparou', [
            'id' => $osc->id_osc,
            'changes' => $osc->getChanges()
        ]);
    }
}