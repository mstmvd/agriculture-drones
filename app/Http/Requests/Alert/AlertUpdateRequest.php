<?php

namespace App\Http\Requests\Alert;

use App\DTOs\Alert\AlertDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AlertUpdateRequest extends FormRequest
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
            'type' => 'numeric|in:2,4,8,16',
            'text' => 'max:1000',
            'distribution_list_id' => 'uuid',
            'severity' => 'numeric'
        ];
    }

    /**
     * Build and return a DTO.
     *
     */
    public function toDTO(): AlertDTO
    {
        try {
            return new AlertDTO($this->validated());
        } catch (UnknownProperties $e) {
            Log::warning($e);
            return new AlertDTO();
        }
    }
}
