<?php

namespace App\DTOs\Alert;

use Spatie\DataTransferObject\DataTransferObject;

class AlertDTO extends DataTransferObject
{
    public ?int $type;
    public ?string $text;
    public ?string $distribution_list_id;
    public ?int $severity;
}
