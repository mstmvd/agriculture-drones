<?php

namespace App\Http\Requests\Alert;

use App\DTOs\Alert\AlertDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AlertStoreRequest extends FormRequest
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
            'type' => 'required|numeric|in:2,4,8,16',
            'text' => 'required|max:1000',
            'distribution_list_id' => 'required|uuid',
            'severity' => 'required|numeric'
        ];
    }

    /**
     * Build and return a DTO.
     *
     */
    public function toDTO(): AlertDTO
    {
        try {
            return new AlertDTO(
                type: $this->input('type'),
                text: $this->input('text'),
                distribution_list_id: $this->input('distribution_list_id'),
                severity: $this->input('severity'),
            );
        } catch (UnknownProperties $e) {
            Log::warning($e);
            return new AlertDTO();
        }
    }
}
