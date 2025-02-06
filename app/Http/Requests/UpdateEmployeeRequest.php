<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'departement_id'        => 'required|integer',
            'nom'                   => 'required|string',
            'prenom'                => 'required|string',
            'email'                 => 'required',
            'contact'               => 'required',
            'montant_journalier'    => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required'        => 'Le mail est requis',
            'contact.required'      => 'Adresse email est requis',
            'nom.required'          => 'Le nom de famille est obligatoire',
            'prenom.required'       => 'Le prénom de famille est obligatoire',
        ];
    }
}
