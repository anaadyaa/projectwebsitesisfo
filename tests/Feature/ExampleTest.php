<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pengunjung yang belum login diarahkan ke halaman login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    /**
     * Halaman login dapat diakses tanpa login.
     */
    public function test_login_page_is_accessible(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    /**
     * User yang sudah login dapat membuka dashboard dan halaman data.
     */
    public function test_authenticated_user_can_open_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/')->assertStatus(200);

        foreach (['kelas', 'siswa', 'guru', 'mapel', 'nilai'] as $page) {
            $this->actingAs($user)->get('/'.$page)->assertStatus(200);
            $this->actingAs($user)->get('/'.$page.'/create')->assertStatus(200);
        }
    }
}
