<?php

namespace App\Models;

use App\Traits\TraitUuid;

/**
 * @property string id
 * @property int type
 * @property string text
 * @property string distribution_list_id
 * @property int severity
 */
class Alert extends AbstractCrudModel
{
    use TraitUuid;
    public $timestamps = true;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'type',
        'text',
        'distribution_list_id',
        'severity',
    ];

    public array $filterable = [
        'id',
        'type',
        'distribution_list_id',
        'severity',
        'created_at',
    ];

    public array $sortable = [
        'type',
        'severity',
    ];
}
