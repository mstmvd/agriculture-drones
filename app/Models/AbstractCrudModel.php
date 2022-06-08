<?php

namespace App\Models;

use App\Scopes\FilterScope;
use App\Scopes\LimitOffsetScope;
use App\Scopes\OrderScope;
use App\Scopes\WithScope;
use App\Traits\ModelTableNameTrait;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractCrudModel extends Model
{
    use ModelTableNameTrait;

    public array $filterable = [];
    public array $sortable = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new OrderScope);
        static::addGlobalScope(new LimitOffsetScope);
        static::addGlobalScope(new WithScope);
    }
}
