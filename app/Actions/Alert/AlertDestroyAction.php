<?php

namespace App\Actions\Alert;

use App\Models\Alert;
use Illuminate\Support\Facades\Cache;

class AlertDestroyAction
{
    /**
     * @param Alert $alert
     * @return bool
     */
    public function execute(Alert $alert): bool
    {
        $alert->delete();
        Cache::forget($alert->id);
        return true;
    }
}
