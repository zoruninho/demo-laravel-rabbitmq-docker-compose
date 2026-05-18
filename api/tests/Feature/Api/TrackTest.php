<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ActAsAuthenticatedUser;

class TrackTest extends TestCase
{
    use ActAsAuthenticatedUser;
    use RefreshDatabase;

    public function test_tracks_endpoint_requires_authentication(): void
    {
        $response = $this->getJson('/api/tracks');

        $response->assertUnauthorized();
    }

    public function test_user_can_fetch_owned_tracks(): void
    {
        $testTitle = 'test_phpunit_track';
        Track::factory()
            ->for($this->authenticatedUser, 'creator')
            ->create([
                'title' => $testTitle,
            ]);

        Track::factory()
            ->for($this->authenticatedUser, 'creator')
            ->count(5)
            ->create();

        $response = $this->withToken($this->token)
            ->getJson('/api/tracks');

        $response->assertOk()
            ->assertJsonCount(6)
            ->assertJsonStructure([
                '*' => ['id', 'title', 'description', 'duration', 'size', 'status', 'creator_id'],
            ])
            ->assertJsonFragment([
                'title' => $testTitle,
            ]);
    }

    public function test_user_can_not_fetch_other_user_tracks(): void
    {
        $testTitle = 'test_phpunit_track';

        $otherUser = User::factory()->create();
        Track::factory()
            ->for($otherUser, 'creator')
            ->create([
                'title' => $testTitle,
            ]);

        $response = $this->withToken($this->token)
            ->getJson('/api/tracks');

        $response->assertOk()
            ->assertJsonCount(0)
            ->assertJsonMissing([
                'title' => $testTitle,
            ]);
    }
}
