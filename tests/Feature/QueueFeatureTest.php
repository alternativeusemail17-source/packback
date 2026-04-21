<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Dress;
use App\Models\Location;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueueFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_queue_and_see_it_in_the_list(): void
    {
        $user = User::factory()->create();
        $from = Location::create(['name' => 'PG']);
        $to = Location::create(['name' => 'Home']);

        $response = $this->actingAs($user)->post(route('queues.store'), [
            'name' => 'Weekend run',
            'from_location_id' => $from->id,
            'to_location_id' => $to->id,
        ]);

        $response->assertRedirect(route('queues.index'));

        $this->assertDatabaseHas('queues', [
            'user_id' => $user->id,
            'name' => 'Weekend run',
            'from_location_id' => $from->id,
            'to_location_id' => $to->id,
        ]);

        $this->actingAs($user)
            ->get(route('queues.index'))
            ->assertOk()
            ->assertSee('PG → Home')
            ->assertSee('Weekend run');
    }

    public function test_user_can_add_and_remove_only_their_own_dress_from_a_queue(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $locationA = Location::create(['name' => 'PG']);
        $locationB = Location::create(['name' => 'Home']);
        $category = Category::create(['name' => 'Casual']);
        $queue = Queue::create([
            'user_id' => $user->id,
            'name' => 'Holiday',
            'from_location_id' => $locationA->id,
            'to_location_id' => $locationB->id,
        ]);
        $userDress = $user->dresses()->create([
            'name' => 'Blue Dress',
            'category_id' => $category->id,
            'location_id' => $locationA->id,
        ]);
        $otherDress = $otherUser->dresses()->create([
            'name' => 'Hidden Dress',
            'category_id' => $category->id,
            'location_id' => $locationA->id,
        ]);

        $this->actingAs($user)
            ->post(route('queues.dresses.store', $queue), [
                'dress_id' => $userDress->id,
            ])
            ->assertRedirect(route('queues.show', $queue));

        $this->assertDatabaseHas('queue_dress', [
            'queue_id' => $queue->id,
            'dress_id' => $userDress->id,
        ]);

        $this->actingAs($user)
            ->post(route('queues.dresses.store', $queue), [
                'dress_id' => $otherDress->id,
            ])
            ->assertNotFound();

        $this->actingAs($user)
            ->delete(route('queues.dresses.destroy', [$queue, $userDress]))
            ->assertRedirect(route('queues.show', $queue));

        $this->assertDatabaseMissing('queue_dress', [
            'queue_id' => $queue->id,
            'dress_id' => $userDress->id,
        ]);
    }

    public function test_user_cannot_open_another_users_queue(): void
    {
        $owner = User::factory()->create();
        $viewer = User::factory()->create();
        $from = Location::create(['name' => 'PG']);
        $to = Location::create(['name' => 'Home']);
        $queue = Queue::create([
            'user_id' => $owner->id,
            'name' => 'Private route',
            'from_location_id' => $from->id,
            'to_location_id' => $to->id,
        ]);

        $this->actingAs($viewer)
            ->get(route('queues.show', $queue))
            ->assertNotFound();
    }
}
