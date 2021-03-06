<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'sometimes|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите имя...',
            'category_id.required' => 'Выберите категорию...',
            'price.numeric' => 'Цена должна быть числом',
        ];
    }
}
