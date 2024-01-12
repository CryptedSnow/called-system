<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'empresa_id' => 'required|exists:empresas,id',
                'titulo' => 'required|max:50',
                'descricao' => 'required',
                'gravidade_id' => 'required|exists:gravidades,id',
                'status' => 'required|in:Andamento,Concluido',
            ],
            'PATCH' => [
                'empresa_id' => 'required|exists:empresas,id',
                'titulo' => 'required|max:50',
                'descricao' => 'required',
                'gravidade_id' => 'required|exists:gravidades,id',
                'status' => 'required|in:Andamento,Concluido',
            ],
        };
    }
}
