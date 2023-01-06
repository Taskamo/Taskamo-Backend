<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method success(array $array)
 * @method error(string $string, int $int)
 */
class AuthenticationController extends Controller
{
    public function createAccount(SignUpRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);

        return $this->success([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function signin(SignInRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    #[ArrayShape(['message' => "string"])] public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
