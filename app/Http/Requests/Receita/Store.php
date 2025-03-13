<?php

namespace App\Http\Requests\Receita;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'receita_titulo' => ['required', 'string', 'max:255'],
            'receita_descricao' => ['required', 'string'],
            'receita_foto' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
            'categoria' => ['required', 'string'],
            'receita_duracao' => ['required', 'string'],
        ];
    }
}
