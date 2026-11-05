<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'services.google.client_id' => 'google-client-id',
        'services.google.client_secret' => 'google-client-secret',
        'services.google.redirect' => 'http://localhost/auth/google/callback',
    ]);
});

test('login screen links to Google authentication', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee(route('google.redirect'));
});

test('Google can authenticate and create a verified user', function () {
    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response([
            'access_token' => 'google-access-token',
        ]),
        'https://openidconnect.googleapis.com/v1/userinfo' => Http::response([
            'sub' => 'google-user-id',
            'email' => 'person@example.com',
            'email_verified' => true,
            'name' => 'Google Person',
        ]),
    ]);

    $state = 'expected-oauth-state';

    $this->withSession(['google_oauth_state' => $state])
        ->get(route('google.callback', ['state' => $state, 'code' => 'authorization-code']))
        ->assertRedirect(route('landing'));

    $this->assertAuthenticated();

    $user = User::where('email', 'person@example.com')->firstOrFail();
    $this->assertSame('Google Person', $user->name);
    $this->assertSame('pencari', $user->role);
    $this->assertNotNull($user->email_verified_at);
});

test('Google login rejects an unverified email', function () {
    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response([
            'access_token' => 'google-access-token',
        ]),
        'https://openidconnect.googleapis.com/v1/userinfo' => Http::response([
            'email' => 'person@example.com',
            'email_verified' => false,
        ]),
    ]);

    $state = 'expected-oauth-state';

    $this->withSession(['google_oauth_state' => $state])
        ->get(route('google.callback', ['state' => $state, 'code' => 'authorization-code']))
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('google');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'person@example.com']);
});

test('Google login rejects an invalid OAuth state', function () {
    $this->withSession(['google_oauth_state' => 'expected-state'])
        ->get(route('google.callback', ['state' => 'unexpected-state', 'code' => 'authorization-code']))
        ->assertStatus(419);

    $this->assertGuest();
});

test('Google login reuses an existing account with the same verified email', function () {
    $user = User::factory()->create([
        'email' => 'person@example.com',
        'email_verified_at' => null,
        'role' => 'pencari',
    ]);

    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response([
            'access_token' => 'google-access-token',
        ]),
        'https://openidconnect.googleapis.com/v1/userinfo' => Http::response([
            'email' => 'person@example.com',
            'email_verified' => true,
            'name' => 'Google Person',
        ]),
    ]);

    $state = 'expected-oauth-state';

    $this->withSession(['google_oauth_state' => $state])
        ->get(route('google.callback', ['state' => $state, 'code' => 'authorization-code']))
        ->assertRedirect(route('landing'));

    $this->assertAuthenticatedAs($user);
    $this->assertSame(1, User::where('email', 'person@example.com')->count());
    $this->assertNotNull($user->fresh()->email_verified_at);
});
