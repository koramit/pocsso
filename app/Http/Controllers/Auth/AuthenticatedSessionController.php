<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request)
    {
        if ($request->has('redirectAfterAuthenticated')) {
            $application = Application::where('url', 'like', $request->redirectAfterAuthenticated.'%')->first();
            Session::put('redirect-to-application', $application);
        }

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

        $application = Session::pull('redirect-to-application');

        if ($application && $user->applications->contains($application)) {
            $response = Http::withHeaders(['token' => $application->token])
                        ->post($application->url, ['user' => Auth::user()])
                        ->json();

            return redirect($response['redirect']);
        }

        return redirect('portal');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
