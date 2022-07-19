<?php

namespace App\Actions\Alert;

use App\DTOs\Alert\AlertDTO;
use App\Helper;
use App\Models\Alert;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AlertBatchUpdateAction
{
    /**
     * @param AlertDTO $alertDTO
     * @return int
     */
    public function execute(AlertDTO $alertDTO): int
    {
        /** @var Alert[] $alerts */
        $alerts = Alert::query()->get();
        $updatedAlerts = DB::transaction(function () use ($alertDTO, $alerts) {
            foreach ($alerts as $alert) {
                $alert->fill(Helper::arrayRemoveNull($alertDTO->toArray()));
                $alert->save();
            }
            return $alerts;
        });
        foreach ($updatedAlerts as $alert) {
            Cache::put($alert->id, $alert);
        }
        return count($updatedAlerts);
    }
}
