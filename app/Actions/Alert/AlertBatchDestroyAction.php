<?php

namespace App\Actions\Alert;

use App\Models\Alert;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AlertBatchDestroyAction
{
    /**
     * @return int
     */
    public function execute(): int
    {
        /** @var Alert[] $alerts */
        $alerts = Alert::query()->get();
        $count = count($alerts);
        DB::transaction(function () use ($alerts) {
            foreach ($alerts as $alert) {
                Cache::forget($alert->id);
                $alert->delete();
            }
        });
        return $count;
    }
}
