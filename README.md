# XDefiant Builds

![tests workflow](https://github.com/CabbagePenetrator/xdefiantbuilds/actions/workflows/ci.yml/badge.svg) [![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Ffa7712c8-9baa-49f2-afe6-76de6322d5a2&style=flat)](https://forge.laravel.com/servers/796183/sites/2373341)

### Requirements

This project uses [Laravel Sail](https://laravel.com/docs/10.x/sail) for local development and requires [Docker](https://docs.docker.com/get-docker) to be installed.

### Setup

Clone the repo

```
git clone git@github.com:CabbagePenetrator/xdefiantbuilds.git
```

Change into the directory

```
cd xdefiantbuilds
```

Install composer dependencies

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Copy the .env example file

```
cp .env.example .env
```

Set sail alias

```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Start the containers

```
sail up -d
```

Set the app key in the .env file

```
sail artisan key:generate
```

Run migrations and seeders

```
sail artisan migrate --seed
```

Install NPM depenedencies

```
sail npm install
```

Run dev server

```
sail npm run watch
```

You should now be able to view the project in your browser on `http://localhost`

Run tests

```
sail test
```
