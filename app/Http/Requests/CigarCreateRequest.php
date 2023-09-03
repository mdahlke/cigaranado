<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CigarCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->authorize('create', Cigar::class);
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'cigar_id' => 'required|exists:cigars,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'string|min:1|max:255',
            'draw' => 'string|min:1|max:255',
            'burn' => 'string|min:1|max:255',
            'flavor' => 'string|min:1|max:255',
            'body' => 'string|min:1|max:255',
            'location' => 'string|min:1|max:255',
            'date' => 'date',
            'image' => 'image',
        ];
    }
}
