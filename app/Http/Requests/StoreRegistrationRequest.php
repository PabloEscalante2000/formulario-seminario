<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255'],
            'pregunta' => ['nullable', 'string', 'max:2000'],
            'numero_acompanantes' => ['required', 'integer', 'min:0', 'max:10'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Ingresa un correo valido.',
            'pregunta.max' => 'La respuesta no puede exceder 2000 caracteres.',
            'numero_acompanantes.required' => 'Indica el numero de acompanantes.',
            'numero_acompanantes.min' => 'El numero de acompanantes no puede ser negativo.',
            'numero_acompanantes.max' => 'El maximo de acompanantes es 10.',
        ];
    }
}
