<?php

namespace App\Http\Controllers;

use App\Facades\Pushover;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeRequest;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $subscribe_url = config('pushover.url');
        $app_url = config('app.url');
        $allowed_scores = array_reverse(config('app.allowed_scores'));
        $score = session('score') ? session('score') : 200;
        session(['nonce' => Str::random('8')]);

        return view('index', compact('subscribe_url', 'app_url', 'allowed_scores', 'score'));
    }

    public function subscribe(SubscribeRequest $request)
    {
        if ($request->nonce != session('nonce')) {
            return redirect('/');
        }

        $groups = config('pushover.groups');

        if ($request->pushover_unsubscribed) {
            $subscriber = Subscriber::where('key', $request->pushover_unsubscribed_user_key)->first();

            if ($subscriber) {
                Pushover::deleteUserFromGroup($groups[$subscriber->score], $subscriber->key);
                $subscriber->delete();
            }

            return redirect('/')->with('unsubscribed', 1);
        } else {
            $subscriber = Subscriber::where('key', $request->pushover_user_key)->first();

            if ($subscriber && $subscriber->score != $request->score) {
                Pushover::deleteUserFromGroup($groups[$subscriber->score], $subscriber->key);
                Pushover::addUserToGroup($groups[$request->score], $subscriber->key);

                $subscriber->update(['score' => $request->score]);
            } else {
                $subscriber = Subscriber::create([
                    'key' => $request->pushover_user_key,
                    'score' => $request->score
                ]);

                Pushover::addUserToGroup($groups[$subscriber->score], $subscriber->key);
            }

            return redirect('/')->with('success', 1)->with('score', $request->score);
        }
    }
}
