# Readme

## Setup

All you need for this to work is PHP 8 and Composer installed on your machine.

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
This will leave you with a dummy user you can use straight away

```
test@tmail.com
password
```
Alternatively you can and should create your own user by registering.

## Endpoints

I won't write swagger documentation for this as it's a simple dummy project. You can find a postman
collection in the root of the project. 

## Notes

There is not too much consistency throughout the project as I adapted slightly different approaches for different CRUDS.
Something even more simple would have worked for this kind of "project", but I'm sure you wouldn't be happy with that 
kind of implementation.

I've dedicated somewhere around 4-5 hours for this implementation, I don't think interview tasks should take more than that.
I'm happy to talk to you about the implementation and about things I'd do differently in a real world situation.
