<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\MasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'body'  => 'nullable|string',
            'privacy' => 'nullable|in:public,private'
        ];
    }
}
