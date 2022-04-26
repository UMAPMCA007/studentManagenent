<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','numeric','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'qualification' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        
        return  User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'qualification' => $input['qualification'],
            'state' => $input['state'],
            'city' => $input['city'],
            'password' => Hash::make($input['password']),
        ]);
        
    }
}
