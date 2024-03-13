<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(PasswordRequest $request): Response
    {
        $validated = $request->validated();

        if (! Auth::attempt([
            'email' => $request->user()->email,
            'password' => $validated['current_password'],
        ])) {
            $errors = ['current_password' => trans('auth.failed')];

            return $request->expectsJson()
                ? response()->json(['message' => $errors['current_password'], 'errors' => $errors], 400)
                : back()->withErrors($errors);
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return $request->expectsJson()
            ? response()->json(['status' => 'password-updated'])
            : back()->with('status', 'password-updated');
    }
}
