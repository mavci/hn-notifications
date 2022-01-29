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
                            <select class="form-select" aria-label="Default select example">
                                <option>50</option>
                                <option>100</option>
                                <option>150</option>
                                <option selected>200</option>
                                <option>250</option>
                                <option>300</option>
                                <option>350</option>
                                <option>400</option>
                                <option>450</option>
                                <option>500</option>
                                <option>550</option>
                                <option>600</option>
                                <option>650</option>
                                <option>700</option>
                                <option>750</option>
                                <option>800</option>
                                <option>850</option>
                                <option>900</option>
                                <option>950</option>
                                <option>1000</option>
                                <option>1500</option>
                                <option>2000</option>
                            </select>
                        </div>
                        <div class="col-12">
                            score.
                        </div>
                        <div class="col-12">
                            <a href="{{ $subscribe_url }}" class="btn btn-primary">Subscribe with Pushover</a>
                        </div>
                    </form>
                </div>
            </div>

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

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
