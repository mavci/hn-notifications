<?php

namespace App\Console\Commands;

use App\Facades\HN;
use App\Facades\Pushover;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CheckStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-stories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $groups = config('pushover.groups');
        $top_stories = array_slice(HN::topStories(), 0, 30);
        $skip_groups = [];

        $subscribed_scores = Subscriber::groupBy('score')->selectRaw('score, COUNT(id) AS count')->first();
        $subscribed_scores = $subscribed_scores ? $subscribed_scores->pluck('score')->toArray() : [];
        $skip_groups = array_values(array_diff(config('app.allowed_scores'), $subscribed_scores));

        foreach ($top_stories as $story_id) {
            $story = HN::getItem($story_id);

            foreach ($groups as $score => $group_key) {
                if (! in_array($score, $skip_groups) && $story['score'] >= $score && ! Cache::get($score . '/' . $story_id)) {
                    $url = isset($story['url']) ? $story['url'] : 'https://news.ycombinator.com/item?id=' . $story_id;
                    Pushover::send($group_key, $story['title'], $url);
                    Cache::put($score . '/' . $story_id, 1, now()->addDays(3));
                    $skip_groups[] = $score;
                }
            }
        }

        return 0;
    }
}
