<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicReservationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for in-memory database tests.');
        }

        parent::setUp();
    }

    public function test_guest_can_request_a_reservation(): void
    {
        $this->createVisibleRoom();

        $response = $this->postJson('/api/reservations', [
            'checkIn' => now()->addDay()->toDateString(),
            'checkOut' => now()->addDays(3)->toDateString(),
            'adults' => 2,
            'children' => 1,
            'roomType' => 'suite-mar',
            'guestName' => 'Lucas Perez',
            'guestEmail' => 'lucas@example.com',
            'guestPhone' => '+54 9 11 1234 5678',
            'website' => '',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.status', 'pendiente');

        $this->assertDatabaseHas('reservations', [
            'customer_email' => 'lucas@example.com',
            'room_type' => 'suite-mar',
            'people_count' => 3,
            'status' => 'pendiente',
        ]);
    }

    public function test_reservation_rejects_invalid_dates_and_honeypot(): void
    {
        $this->createVisibleRoom();

        $response = $this->postJson('/api/reservations', [
            'checkIn' => now()->addDays(3)->toDateString(),
            'checkOut' => now()->addDay()->toDateString(),
            'adults' => 2,
            'children' => 0,
            'roomType' => 'suite-mar',
            'guestName' => 'Lucas Perez',
            'guestEmail' => 'lucas@example.com',
            'guestPhone' => '+54 9 11 1234 5678',
            'website' => 'spam',
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['checkOut', 'website']);
    }

    public function test_reservation_rejects_unavailable_room_dates(): void
    {
        $this->createVisibleRoom();

        Reservation::create([
            'customer_name' => 'Ana Gomez',
            'customer_email' => 'ana@example.com',
            'customer_phone' => '+54 9 11 9876 5432',
            'reservation_date' => now()->addDay()->setTime(15, 0),
            'check_in' => now()->addDay()->toDateString(),
            'check_out' => now()->addDays(3)->toDateString(),
            'room_type' => 'suite-mar',
            'adults' => 2,
            'children' => 0,
            'people_count' => 2,
            'status' => 'confirmada',
        ]);

        $response = $this->postJson('/api/reservations', [
            'checkIn' => now()->addDays(2)->toDateString(),
            'checkOut' => now()->addDays(4)->toDateString(),
            'adults' => 2,
            'children' => 0,
            'roomType' => 'suite-mar',
            'guestName' => 'Lucas Perez',
            'guestEmail' => 'lucas@example.com',
            'guestPhone' => '+54 9 11 1234 5678',
            'website' => '',
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['roomType']);
    }

    private function createVisibleRoom(): Product
    {
        return Product::create([
            'name' => 'Suite Vista Mar',
            'slug' => 'suite-mar',
            'description' => 'Habitacion con vista al mar.',
            'price' => 120000,
            'stock' => 4,
            'is_active' => true,
            'is_visible' => true,
        ]);
    }
}
