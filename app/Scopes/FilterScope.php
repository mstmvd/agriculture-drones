<?php

namespace App\Scopes;

use App\Models\AbstractCrudModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Str;

class FilterScope implements Scope
{

    private array $operators = [
        'gt' => '>',
        'gte' => '>=',
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'lte' => '<=',
    ];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param AbstractCrudModel $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
//        dd(request()->query());
        foreach (request()->query() as $item => $value) {
            @list($field, $operator) = explode(':', $item);
            if (!$operator) {
                $operator = 'eq';
            }
//            dump($field, $operator, $value);
            if (in_array(Str::snake($field), $model->filterable)) {
                $filterMethod = Str::camel($field) . 'Filter';
                if (method_exists($model, $filterMethod)) {
                    $model->{$filterMethod}($builder, $value);
                } else {
                    $builder->where(Str::snake($field), $this->operators[$operator], $value);
                }
            }
        }
    }
}
