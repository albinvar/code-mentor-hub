<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $tags = json_decode($input['tags'], true);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        Validator::make($tags, [
            '*' => 'sometimes|string|max:30',
        ], [
            '*.string' => 'Invalid tag value :input must be a string.',
            '*.max' => 'Invalid tag value: :input . Maximum value allowed is :max.',
        ])->validate();

        return DB::transaction(function () use ($input, $tags) {
            $user = new User([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
            $user->save();

            $profile = new Profile([
                'user_id' => $user->id,
                'bio' => 'This is my bio',
                'location' => $input['location'],
            ]);

            $profile->save();

            $user->assignRole('User');

            $profile->attachTags($tags);

            return $user;
        });
    }
}
