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
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'body' => 'required|string|min:10',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.min' => 'A descrição deve conter pelo menos :min caracteres.',
            'body.required' => 'O campo conteúdo é obrigatório.',
            'body.min' => 'O conteúdo deve conter pelo menos :min caracteres.',
            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O campo preço deve ser um número.',
            'categories.required' => 'O campo categorias é obrigatório.',
            'photos.*.image' => 'Cada arquivo deve ser uma imagem.',
        ];
    }
}
