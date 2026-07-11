<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartDeliveryAddressTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
    }

    /** @test */
    public function guests_cannot_store_addresses()
    {
        $response = $this->postJson('/addresses', [
            'label' => 'Home',
            'recipient_name' => 'John Doe',
            'phone' => '+2348012345678',
            'street_address' => '123 Test Street',
            'city' => 'Lekki',
            'state' => 'Lagos',
            'is_default' => true,
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_store_address_via_ajax()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/addresses', [
            'label' => 'Home',
            'recipient_name' => 'John Doe',
            'phone' => '+2348012345678',
            'street_address' => '123 Test Street',
            'city' => 'Lekki',
            'state' => 'Lagos',
            'is_default' => true,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Address added successfully!',
        ]);

        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'label' => 'Home',
            'recipient_name' => 'John Doe',
            'phone' => '+2348012345678',
            'street_address' => '123 Test Street',
            'city' => 'Lekki',
            'state' => 'Lagos',
            'is_default' => true,
        ]);
    }

    /** @test */
    public function validation_fails_if_required_fields_are_missing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/addresses', [
            'label' => '',
            'recipient_name' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['label', 'recipient_name', 'phone', 'street_address', 'city', 'state']);
    }

    /** @test */
    public function setting_an_address_as_default_unsets_previous_default()
    {
        $user = User::factory()->create();

        // Create initial default address
        $address1 = Address::create([
            'user_id' => $user->id,
            'label' => 'Work',
            'recipient_name' => 'Jane Doe',
            'phone' => '+2348011111111',
            'street_address' => '456 office way',
            'city' => 'Ikeja',
            'state' => 'Lagos',
            'is_default' => true,
        ]);

        // Store new default address via JSON post
        $response = $this->actingAs($user)->postJson('/addresses', [
            'label' => 'Home',
            'recipient_name' => 'John Doe',
            'phone' => '+2348012345678',
            'street_address' => '123 Test Street',
            'city' => 'Lekki',
            'state' => 'Lagos',
            'is_default' => true,
        ]);

        $response->assertStatus(200);

        // Verify database
        $this->assertDatabaseHas('addresses', [
            'id' => $address1->id,
            'is_default' => false,
        ]);

        $this->assertDatabaseHas('addresses', [
            'label' => 'Home',
            'is_default' => true,
        ]);
    }
}
