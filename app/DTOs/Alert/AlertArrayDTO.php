<?php

namespace App\DTOs\Alert;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class AlertArrayDTO extends DataTransferObject
{
    /** @var AlertDTO[] */
    #[CastWith(ArrayCaster::class, itemType: AlertDTO::class)]
    public array $alerts;
}
