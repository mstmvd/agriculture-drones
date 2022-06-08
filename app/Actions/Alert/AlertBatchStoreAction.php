<?php

namespace App\Actions\Alert;

use App\DTOs\Alert\AlertArrayDTO;
use App\Models\Alert;
use Illuminate\Support\Facades\Cache;

class AlertBatchStoreAction
{
    /**
     * @param AlertArrayDTO $alertDTOs
     * @return Alert[]
     */
    public function execute(AlertArrayDTO $alertDTOs): array
    {
        $alerts = [];
        foreach ($alertDTOs->alerts as $alertDTO) {
            /** @var Alert $alert */
            $alert = Alert::query()->create($alertDTO->all());
            $alerts[] = $alert;
            Cache::put($alert->id, $alert);
        }
        return $alerts;
    }
}
