<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class PortalController extends Controller
{
    public function __invoke()
    {
        $url = parse_url(URL::previous());
        $query = $url['query'] ?? null;

        if (! $query) {
            return view('auth.portal');
        }

        if (strpos($query, 'redirectAfterAuthenticated=') === false) {
            abort(404);
        }

        $url = urldecode(str_replace('redirectAfterAuthenticated=', '', $query)).'%';

        $application = Application::where('url', 'like', $url)->first();

        if ($application && Auth::user()->applications->contains($application)) {
            $response = Http::withHeaders(['token' => $application->token])
                        ->post($application->url, ['user' => Auth::user()])
                        ->json();

            return redirect($response['redirect']);
        }

        abort(401);
    }
}
