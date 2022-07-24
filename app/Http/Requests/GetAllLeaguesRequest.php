<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GetAllLeaguesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_timestamp' => ['integer', 'min:1', 'max:' . (int)Carbon::now()->timestamp * 2],
        ];
    }
}
