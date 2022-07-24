<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetLeagueByIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->merge(['id' => $this->route('league_id')]);
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
            'id' => ['required', 'integer', 'exists:leagues'],
        ];
    }
}
