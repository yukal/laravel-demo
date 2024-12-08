<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Movie;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string', 'ascii', 'min:3', 'max:80',
            ],

            'genres' => [
                'sometimes',
                'required',
                'list', 'min:1',
            ],

            'poster' => [
                'sometimes',
                'required',
                'image', 'mimes:jpeg,jpg,png,gif', 'max:2048',
            ],

            'status' => [
                'sometimes',
                'numeric',
                'in:' . implode(',', array_keys(Movie::getStatuses()))
            ],
        ];
    }
}
