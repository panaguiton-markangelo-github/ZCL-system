<?php

namespace App\Http\Requests;

use App\Models\Librarians;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LibrarianProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(Librarians::class)->ignore($this->user()->id)],
        ];
    }
}
