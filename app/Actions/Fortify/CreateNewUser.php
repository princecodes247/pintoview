<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $slug = Str::slug($input['name']);

        $count = 0;
        $newSlug = $slug;
        while (User::where('slug', $newSlug)->exists()) {
            $count++;
            $newSlug = $slug . '-' . $count;
        }
        if ($count > 0) {
            $slug = $newSlug;
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'slug' => $slug,
            'password' => Hash::make($input['password']),
        ]);
    }
}
