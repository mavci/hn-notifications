# Hacker News Notification

> This is a third-party, unofficial, open-source service and not affiliated with Hacker News or YC.

[Hacker News]() is part of my daily life. I try to follow the top stories every day when I have the opportunity. In order not to miss important stories on my busy days, I prepared a notification service. It was a very simple, 43-line PHP script that sends me notifications for stories with over 200 points. I have been using this service for 7 months and I no longer worry about missing important stories.

Finally, I made this service available to everyone so that it can be useful to others. I have also obtained the necessary permissions from the HN moderators to share such a service with you. So, I hope you will not miss important stories from this awesome platform with the help of this service. Also when I share this service with HN, I hope I will receive this story as a notification.

## Roadmap

- [ ] Send notification for the top story with the desired score
- [ ] Send notification for stories with requested keywords
- [ ] Send notification for replies to my comments

## Built With

* [Laravel](https://laravel.com/)
* [Bootstrap](https://getbootstrap.com/)
* [Pushover](https://pushover.net/)
* [Docker](https://www.docker.com/)


## Installation

```bash
cp docker/mysql/.env.example docker/mysql/.env
cp .env.example .env
# Update the following environment variables inside .env file
# Pushover app token (PUSHOVER_APP_TOKEN and PUSHOVER_APP_URL)
# Pushover groups keys (PUSHOVER_..._SCORE_GROUP_KEY)
# UID for proccess user, make sure files also 'chown'ed with that UID

docker-compose pull
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
```

## Build PHP FPM Docker image

```bash
cd docker/images/php-fpm
docker build -t ghcr.io/mavci/hnn-php-fpm:latest .
docker push ghcr.io/mavci/hnn-php-fpm:latest
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
This project is open-sourced software licensed under the [MIT license](https://choosealicense.com/licenses/mit/).
