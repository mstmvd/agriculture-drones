<?php

namespace App\Actions\Alert;

use App\DTOs\Alert\AlertDTO;
use App\Models\Alert;
use Illuminate\Support\Facades\Cache;

class AlertStoreAction
{
    /**
     * @param AlertDTO $alertDTO
     * @return Alert
     */
    public function execute(AlertDTO $alertDTO): Alert
    {
        /** @var Alert $alert */
        $alert = Alert::query()->create($alertDTO->all());
        Cache::put($alert->id, $alert);
        return $alert;
    }
}
