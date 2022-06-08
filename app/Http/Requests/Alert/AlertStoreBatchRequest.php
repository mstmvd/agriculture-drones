<?php

namespace App\Http\Requests\Alert;

use App\DTOs\Alert\AlertArrayDTO;
use App\DTOs\Alert\AlertDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AlertStoreBatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alerts.*.type' => 'required|numeric|in:2,4,8,16',
            'alerts.*.text' => 'required|max:1000',
            'alerts.*.distribution_list_id' => 'required|uuid',
            'alerts.*.severity' => 'required|numeric'
        ];
    }

    /**
     * Build and return a DTO.
     *
     */
    public function toDTO(): AlertArrayDTO
    {
        $alertDTOs = [];
        foreach ($this->input('alerts') as $alert) {
            try {
                $alertDTOs[] = new AlertDTO(
                    type: $alert['type'],
                    text: $alert['text'],
                    distribution_list_id: $alert['distribution_list_id'],
                    severity: $alert['severity'],
                );
            } catch (UnknownProperties $e) {
                Log::warning($e);
            }
        }
        try {
            return new AlertArrayDTO(alerts: $alertDTOs);
        } catch (UnknownProperties $e) {
            Log::warning($e);
            return new AlertArrayDTO();
        }
    }
}
