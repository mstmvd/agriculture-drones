<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property int type
 * @property string text
 * @property string distributionListID
 */
class Alert extends Model
{
    use TraitUuid;
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'type',
        'text',
        'distributionListID'
    ];
}
