<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1;

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            if(!$user->is_customer)
                return response()->json($user);
            else
                Auth::logout();
        }

        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => "successfully Logged out"]);
    }

    public function forgotPassword(Request $request, UserService $service)
    {
        $request->validate(['email' => 'required|email']);

        $user = $service->findByEmail($request->email);

        if($user && !$user->is_customer) {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([]);
            }
        }

        return response()->json([]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ]);

            $user->save();

            event(new PasswordReset($user));
        }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([]);
        }
        return response()->json([], 401);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }

    public function user()
    {
        if ($user = auth()->user()) {
            return response()->json($user);
        } else {
            return response()->json([], 401);
        }
    }
}
