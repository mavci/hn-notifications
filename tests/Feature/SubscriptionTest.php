<?php

namespace Tests\Feature;

use App\Facades\Pushover;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_subscribe()
    {

        $nonce = Str::random('8');
        $user_key = Str::random('30');
        $score = 200;
        $groups = config('pushover.groups');

        Pushover::shouldReceive('addUserToGroup')
            ->once()
            ->with($groups[$score], $user_key)
            ->andReturn(true);

        $query = [
            'nonce' => $nonce,
            'success' => 1,
            'score' => $score,
            'pushover_user_key' => $user_key
        ];

        $response = $this
            ->session(['nonce' => $nonce])
            ->get('/subscribe?'.http_build_query($query));

        $response->assertStatus(302)->assertRedirect('/')->assertSessionHas('success', 1);

        $this->assertTrue(Subscriber::where('key', $user_key)->exists());
    }

    public function test_update_subscribe()
    {
        $nonce = Str::random('8');
        $user_key = Str::random('30');
        $old_score = 250;
        $new_score = 200;
        $groups = config('pushover.groups');


        Subscriber::create([
            'key' => $user_key,
            'score' => $old_score
        ]);

        Pushover::shouldReceive('deleteUserFromGroup')
            ->once()
            ->with($groups[$old_score], $user_key)
            ->andReturn(true);

        Pushover::shouldReceive('addUserToGroup')
            ->once()
            ->with($groups[$new_score], $user_key)
            ->andReturn(true);

        $query = [
            'nonce' => $nonce,
            'success' => 1,
            'score' => $new_score,
            'pushover_user_key' => $user_key
        ];

        $response = $this
            ->session(['nonce' => $nonce])
            ->get('/subscribe?' . http_build_query($query));

        $response->assertStatus(302)->assertRedirect('/')->assertSessionHas('success', 1);
    }

    public function test_delete_subscription()
    {
        $nonce = Str::random('8');
        $user_key = Str::random('30');
        $score = 250;
        $groups = config('pushover.groups');

        Subscriber::create([
            'key' => $user_key,
            'score' => $score
        ]);

        Pushover::shouldReceive('deleteUserFromGroup')
            ->once()
            ->with($groups[$score], $user_key)
            ->andReturn(true);

        $query = [
            'nonce' => $nonce,
            'success' => 1,
            'score' => $score,
            'pushover_unsubscribed_user_key' => $user_key,
            'pushover_unsubscribed' => 1
        ];

        $response = $this
            ->session(['nonce' => $nonce])
            ->get('/subscribe?' . http_build_query($query));

        $response->assertStatus(302)->assertRedirect('/')->assertSessionHas('unsubscribed', 1);

        $this->assertTrue(Subscriber::where('key', $user_key)->doesntExist());
    }


}
