<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToProvider(Request $request): RedirectResponse
    {
        $config = $this->googleConfig();

        if ($config === null) {
            return to_route('login')->withErrors([
                'google' => 'Login Google belum dikonfigurasi. Isi kredensial Google OAuth terlebih dahulu.',
            ]);
        }

        $state = Str::random(40);
        $request->session()->put('google_oauth_state', $state);

        $query = http_build_query([
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect'],
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $state,
            'prompt' => 'select_account',
        ], '', '&', PHP_QUERY_RFC3986);

        return redirect()->away('https://accounts.google.com/o/oauth2/v2/auth?'.$query);
    }

    public function handleProviderCallback(Request $request): RedirectResponse
    {
        $config = $this->googleConfig();

        if ($config === null) {
            return to_route('login')->withErrors([
                'google' => 'Login Google belum dikonfigurasi. Isi kredensial Google OAuth terlebih dahulu.',
            ]);
        }

        $expectedState = $request->session()->pull('google_oauth_state');
        $receivedState = $request->query('state');

        if (
            ! is_string($expectedState)
            || ! is_string($receivedState)
            || ! hash_equals($expectedState, $receivedState)
        ) {
            abort(419, 'Sesi login Google tidak valid. Silakan coba lagi.');
        }

        if ($request->filled('error')) {
            return to_route('login')->withErrors([
                'google' => 'Login Google dibatalkan atau tidak dapat dilanjutkan.',
            ]);
        }

        $code = $request->query('code');

        if (! is_string($code) || $code === '') {
            abort(400, 'Kode otorisasi Google tidak ditemukan.');
        }

        $tokenResponse = Http::asForm()
            ->post('https://oauth2.googleapis.com/token', [
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'redirect_uri' => $config['redirect'],
                'grant_type' => 'authorization_code',
                'code' => $code,
            ])
            ->throw()
            ->json();

        if (! is_array($tokenResponse)) {
            abort(502, 'Google mengembalikan respons token yang tidak valid.');
        }

        $accessToken = $tokenResponse['access_token'] ?? null;

        if (! is_string($accessToken) || $accessToken === '') {
            abort(502, 'Google tidak mengembalikan access token yang valid.');
        }

        $profile = Http::withToken($accessToken)
            ->get('https://openidconnect.googleapis.com/v1/userinfo')
            ->throw()
            ->json();

        if (! is_array($profile)) {
            abort(502, 'Google mengembalikan profil pengguna yang tidak valid.');
        }

        $email = $profile['email'] ?? null;
        $emailVerified = $profile['email_verified'] ?? false;

        if (
            ! is_string($email)
            || filter_var($email, FILTER_VALIDATE_EMAIL) === false
            || $emailVerified !== true
        ) {
            return to_route('login')->withErrors([
                'google' => 'Akun Google harus memiliki alamat email yang valid dan terverifikasi.',
            ]);
        }

        $email = Str::lower($email);
        $name = $profile['name'] ?? Str::before($email, '@');

        if (! is_string($name) || trim($name) === '') {
            $name = Str::before($email, '@');
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Str::random(64),
                'role' => 'pencari',
            ],
        );

        if (! $user->hasVerifiedEmail()) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('landing');
    }

    /**
     * @return array{client_id: string, client_secret: string, redirect: string}|null
     */
    private function googleConfig(): ?array
    {
        $config = config('services.google');

        if (! is_array($config)) {
            return null;
        }

        foreach (['client_id', 'client_secret', 'redirect'] as $key) {
            if (! is_string($config[$key] ?? null) || $config[$key] === '') {
                return null;
            }
        }

        return $config;
    }
}
