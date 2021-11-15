# Instalation # 


## Docker ##

Just run `docker-compose up -d` then go to app container and init trough php artisan commands.

`composer install`
`php artisan key:generate`
`php artisan migrate --seed`

After run tests `php artisan test` to see if endpoints are working correctly.

## Without docker ##

In backend folder setup .env file then run commands:

`composer install`
`php artisan key:generate`
`php artisan migrate --seed`

After run tests `php artisan test` to see if endpoints are working correctly.

In frontend folder setup .env file with VUE_APP_API_URL variable pointing to backend api then run commands:

`npm install`
`npm run serve` or `npm run build`


# Project #

All enpoints have tests writen.
Database seeders are setup.
 