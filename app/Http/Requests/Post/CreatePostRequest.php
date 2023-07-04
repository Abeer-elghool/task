<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\MasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'body'  => 'required|string',
            'privacy' => 'required|in:public,private'
        ];
    }
}
