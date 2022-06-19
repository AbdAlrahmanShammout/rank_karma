<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FindRankUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', Rule::exists('users')],
            'per_page' => ['integer', 'min:1'],
        ];
    }


    public function all($keys = null)
    {
        $data = parent::all();
        $data['id'] = $this->route('id');
        return $data;
    }
}
