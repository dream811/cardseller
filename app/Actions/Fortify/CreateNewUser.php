<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'nickname' => ['required', 'string', 'max:255'],
            'bank_user' => ['required', 'string', 'max:50'],
            'bank_id' => ['required'],
            'bank_account' => ['required'],
            'phone' => ['required', Rule::unique(User::class)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'str_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'str_id' => $input['str_id'],
            'type' => 'USER',
            'name' => $input['name'],
            'nickname' => $input['nickname'],
            'bank_id' => $input['bank_id'],
            'bank_user' => $input['bank_user'],
            'bank_account' => $input['bank_account'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'referer' => $input['referer'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
