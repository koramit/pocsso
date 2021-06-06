<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $user = User::whereLogin($request->login)->first();
        if (! $user || $request->login !== $request->password) {
            throw ValidationException::withMessages([
                'login' => 'credentials not match our records',
            ]);
        }

        Auth::login($user);

        return redirect('portal');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
