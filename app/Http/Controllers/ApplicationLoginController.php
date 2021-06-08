<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ApplicationLoginController extends Controller
{
    public function __invoke(Application $application)
    {
        $response = Http::withHeaders(['token' => $application->token])
                        ->post($application->url, ['user' => Auth::user()]);

        return Inertia::location($response->json()['redirect']);
    }
}
