Stockopedia Code Test
=====================

Setup instructions
------------------

`composer install,` and copy env.example to .env

`touch database/stockopedia.sqlite` to create database file

`php artisan migrate --seed` to set up database and test data


Tests
-----

`php artisan test` to run unit and feature tests


Usage
-----

Post json to route `api/evaluate`
