<?php

namespace App\Http\Resources\Alert;

use App\Http\Resources\AbstractResource;
use App\Models\Alert;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use JsonSerializable;

class AlertResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $data = [];

        if (!is_null($this->resource)) {
            /** @var Alert $alert */
            $alert = $this->resource;
            $data = Arr::only($alert->toArray(), [
                'id',
                'type',
                'text',
                'distribution_list_id',
                'severity',
                'created_at'
            ]);
        }

        return $data;
    }
}
