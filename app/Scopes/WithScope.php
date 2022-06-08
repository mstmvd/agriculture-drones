<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Str;

class WithScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $with = request()->query('with');
        if ($with) {
            $items = is_array($with) ? $with : explode(',', $with);
            $methods = [];
            foreach (get_class_methods($model) as $item) {
                $methods[Str::camel($item)] = $item;
            }
            foreach ($items as $item) {
                if (isset($methods[Str::camel($item)])) {
                    $builder->with($methods[Str::camel($item)]);
                }
            }
        }
    }
}
