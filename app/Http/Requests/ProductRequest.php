<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id'   => 'required',
            'name'          => 'required|string',
            'short_desc'    => 'required|string',
            'slug'          => 'required|string',
            'price'         => 'required',
            'publish'       => 'required|boolean',

            'province_code' => 'required|string',
            'city_code'     => 'required|string',
            'address'          => 'required|string',
            'long_desc'     => 'required|string',
            'lat'           => 'required',
            'long'          => 'required',
            'type_sales'    => 'required|string',
            'no_pic'        => 'required',

            'photos'        => 'required|array', // Ensure 'photos' is an array
            'photos.*'      => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each photo in the array
        ];
    }
}
