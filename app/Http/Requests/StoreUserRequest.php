<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email:rfc,dns|unique:users,email',
            'role' => ['required', new Enum(Role::class)],
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'email' => str(request('email'))
            ->squish()
            ->lower()
            ->value(),
        ]);
    }
}
