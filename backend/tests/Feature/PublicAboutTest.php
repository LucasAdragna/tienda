<?php

namespace Tests\Feature;

use App\Models\AboutUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicAboutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for in-memory database tests.');
        }

        parent::setUp();
    }

    public function test_public_api_returns_the_active_about_content(): void
    {
        AboutUs::create([
            'so_titulo' => 'Nuestra historia',
            'so_texto' => 'Un hotel pensado para que disfrutes cada estadía.',
            'so_imagen' => 'about-us/hotel.webp',
            'so_pdf' => 'about-us/brochure.pdf',
            'so_activo' => true,
        ]);

        $response = $this->getJson('/api/sobre-nosotros');

        $response
            ->assertOk()
            ->assertJsonPath('data.title', 'Nuestra historia')
            ->assertJsonPath('data.image', asset('storage/about-us/hotel.webp'))
            ->assertJsonPath('data.pdf', asset('storage/about-us/brochure.pdf'));
    }

    public function test_public_api_hides_inactive_about_content(): void
    {
        AboutUs::create([
            'so_titulo' => 'Contenido oculto',
            'so_texto' => 'No debe mostrarse.',
            'so_imagen' => 'about-us/hidden.webp',
            'so_pdf' => 'about-us/hidden.pdf',
            'so_activo' => false,
        ]);

        $this->getJson('/api/sobre-nosotros')
            ->assertOk()
            ->assertJsonPath('data', null);
    }
}
