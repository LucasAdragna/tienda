<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for in-memory database tests.');
        }

        parent::setUp();
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
        ]);

        $this->post(route('admin.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_login_with_legacy_plaintext_password_and_it_is_rehashed(): void
    {
        DB::table('users_admin')->insert([
            'name' => 'Legacy Admin',
            'email' => 'legacy-admin@example.com',
            'password' => 'LegacyPass123',
            'remember_token' => null,
            'visible' => true,
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->post(route('admin.login.store'), [
            'email' => 'legacy-admin@example.com',
            'password' => 'LegacyPass123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
        $this->assertTrue(Hash::check('LegacyPass123', DB::table('users_admin')->where('email', 'legacy-admin@example.com')->value('password')));
    }
}
