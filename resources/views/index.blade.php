<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-dark.min.css" rel="stylesheet">

    <meta name="theme-color" content="#111111" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: dark)">

    <title>Hacker News Notifications</title>

    <style>
        .title {
            letter-spacing: -1px;
            color: #FD6721
        }

        @media (prefers-color-scheme: dark) {
            .github-logo {
                filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(237deg) brightness(103%) contrast(102%);
            }
        }
    </style>
</head>

<body>
    <div class="col-lg-8 mx-auto p-3 py-md-5">
        <header class="pb-3 mb-4 border-bottom">

            <div class="row justify-content-between">
                <div class="col-8">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <h1 class="title"><strong>Hacker News Notifications</strong></h1>
                    </a>
                </div>
                <div class="col-4 d-flex flex-row-reverse">
                    <a target="_blank" href="https://github.com/mavci/hn-notifications">
                        <img class="github-logo" width="50" src="/assets/img/github.svg">
                    </a>
                </div>
            </div>
        </header>
        <div class="small alert alert-warning">This is a third-party, unofficial, open-source service and not affiliated with Hacker News or YC.</div>
        <main>
            <p><a target="_blank" href="https://news.ycombinator.com">Hacker News</a> is part of my daily life. I try to follow the top stories every day when I have the opportunity. In order not to miss important stories on my busy days, I prepared a notification service. It was a very simple, <a target="_blank" href="https://github.com/mavci/hn-notifications/blob/main/legacy.php.txt">~40-line PHP script</a> that sends me notifications for stories with over 200 points. I have been using this service for 7 months and I no longer worry about missing important stories.</p>

            <p>Finally, I made this service available to everyone so that it can be useful to others. I have also obtained the necessary permissions from the HN moderators to share such a service with you. So, I hope you will not miss important stories from this awesome platform with the help of this service. Also when I share this service with HN, I hope I will receive this story as a notification.</p>
            <div class="card bg-light">
                <div class="card-body">
                    <form class="row row-cols-lg-auto g-3 align-items-center">
                        <div class="col-12">
                            Send me a push notifications if a story gets more than
                        </div>
                        <div class="col-12">
                            <select class="form-select" id="score">
                                @foreach ($allowed_scores as $_score)
                                <option{{ $_score == $score ? ' selected' : ''}}>{{ $_score }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            score.
                        </div>
                        <div class="col-12">
                            <a id="subscribe" href="#" class="btn btn-primary">Subscribe with Pushover</a>
                        </div>
                    </form>
                </div>
            </div>

            @if (Request::has('failure'))
            <div class="small alert alert-danger mt-3">Subscribe request failed, please try again.</div>
            @endif

            @if (session('success'))
            <div class="small alert alert-success mt-3">You are successfuly subscribed for {{ $score }} score stories.</div>
            @endif

            @if (session('unsubscribed'))
            <div class="small alert alert-success mt-3">You are successfuly unsubscribed.</div>
            @endif

            <hr>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h2>To Unsubscribe</h2>
                    <p>Go to your <a target="_blank" href="https://pushover.net">pushover.net</a> dashboard and click "Edit or Unsubscribe" link at "Hacker News" application and then click unsubscribe. Or click "Subscribe with Pushover" button above and click unsubscribe.</p>
                </div>

                <div class="col-md-6">
                    <h2>Future Features</h2>
                    <p>I am planning to add keyword and comment reply notifications too. But to make it simple and start with MVP, I want to share with this first main feature. So instead of waiting more, you can start using main feature already.</p>
                </div>
            </div>
        </main>
        <footer class="pt-5 text-muted border-top">
            <a href="https://github.com/mavci/hn-notifications" target="_blank">GitHub Repository</a> &middot; 2022
        </footer>
    </div>

    <script>
        const APP_URL = "{{ $app_url }}";
        const SUBSCRIBE_URL = "{{ $subscribe_url }}";
        const NONCE = "{{ session('nonce') }}";
        var score = "{{ $score }}";

        function updateSubscribeLink(score) {
            let URL = SUBSCRIBE_URL +
                '?success=' + escape(APP_URL + '/subscribe?success=1&score=' + score + '&nonce=' + NONCE) +
                '&failure=' + escape(APP_URL + '?failure=1&nonce=' + NONCE);

            document.getElementById('subscribe').href = URL;
        }

        updateSubscribeLink(score);

        document.getElementById('score').onchange = function(event) {
            score = this.value
            updateSubscribeLink(score);
        }
    </script>
</body>

</html>
