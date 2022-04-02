<?php

namespace App\Http\Requests\Api;

use App\Models\Api\Support;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupport extends FormRequest
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
    public function rules(Support $support)
    {
        return [
            'lesson_id' => ['required', 'exists:lessons,id'],
            'description' => ['required', 'min:3', 'max:10000'],
            'status' => ['required', Rule::in(array_keys($support->statusOptions))],
        ];
    }
}
