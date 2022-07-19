<?php

namespace App\Actions\Alert;

use App\DTOs\Alert\AlertArrayDTO;
use App\Models\Alert;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AlertBatchStoreAction
{
    /**
     * @param AlertArrayDTO $alertDTOs
     * @return Alert[]
     */
    public function execute(AlertArrayDTO $alertDTOs): array
    {
        $alerts = DB::transaction(function () use ($alertDTOs) {
            $alerts = [];
            foreach ($alertDTOs->alerts as $alertDTO) {
                /** @var Alert $alert */
                $alert = Alert::query()->create($alertDTO->all());
                $alerts[] = $alert;
            }
            return $alerts;
        });
        foreach ($alerts as $alert) {
            Cache::put($alert->id, $alert);
        }
        return $alerts;
    }
}
