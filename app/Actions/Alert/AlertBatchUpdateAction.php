<?php

namespace App\Actions\Alert;

use App\DTOs\Alert\AlertDTO;
use App\Helper;
use App\Models\Alert;
use Illuminate\Support\Facades\Cache;

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
        $count = count($alerts);
        foreach ($alerts as $alert) {
            Cache::forget($alert->id);
            $alert->fill(Helper::arrayRemoveNull($alertDTO->toArray()));
            $alert->save();
            Cache::put($alert->id, $alert);
        }
        return $count;
    }
}
