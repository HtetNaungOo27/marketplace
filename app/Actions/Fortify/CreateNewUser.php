<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Validation\Rules;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'in:Customer,Vendor'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? null,
            'password' => Hash::make($input['password']),
            'role' => $input['role'] ?? 'Customer',
        ]);

        if ($user->role === 'Vendor') {
            \App\Models\Vendor::create([
                'user_id' => $user->id,
                'store_name' => $user->name . "'s Store",
                'business_license' => null,
                'approval_status' => 'Pending',
                'join_date' => now(),
            ]);
        }

        if ($user->role === 'Customer') {
            \App\Models\Customer::create([
                'user_id' => $user->id,
                'shipping_address' => null,
            ]);
        }

        return $user;
    }
}
