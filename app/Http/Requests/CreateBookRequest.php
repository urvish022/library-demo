<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_name' => 'required',
            'book_year' => 'required',
            'name' => 'required',
            'birth_date' => 'required',
            'genre' => 'required',
            'library_name' => 'required',
            'library_address' => 'required'
        ];
    }
}
