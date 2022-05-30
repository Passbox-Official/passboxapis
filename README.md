# Passbox

## About

> Note: This repository contains the API code of the Passbox password manager. The frontend of the project is available at [Passbox frontend](https://github.com/bijaydas/passboxui)

Passbox is a open source password manager, which you controll from start to finish. You host the application completely. Every password or any component you save that would be your defined database. No third party company should have your passwords.

## Getting started

### Prerequisites

1. Git
2. PHP > 8.0
3. PHP Composer
4. Docker
5. Postman (Optional)

### Installation

1. `cd laravelapis`
2. `cp .env.example .env`
3. `composer install`
4. `php artisan key:generate`
5. `./vendor/bin/sail up build -d`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://github.com/Passbox-Official/passboxapis/blob/main/LICENSE)
