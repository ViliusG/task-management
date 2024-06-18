# Readme

## Setup

All you need for this to work is PHP 8 installed on your machine.

Run the following commands to setup the project. It will do the following

- Install the dependencies
- Create a sqlite database
- Copy the .env.example file to .env
- Run the migrations and seed the database
- Start the development server

```bash
composer install
touch database/database.sqlite
cp .env.example .env
php artisan migrate --seed
php artisan serve
```
