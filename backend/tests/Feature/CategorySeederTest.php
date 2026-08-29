<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorySeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for in-memory database tests.');
        }

        parent::setUp();
    }

    public function test_database_seeder_creates_seven_room_types(): void
    {
        $this->seed();

        $this->assertSame(7, Category::count());
        $this->assertDatabaseHas('categories', ['name' => 'Habitacion Simple']);
        $this->assertDatabaseHas('categories', ['name' => 'Suite Familiar']);
    }
}
