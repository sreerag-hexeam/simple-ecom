Installation

Please check the official laravel installation guide for server requirements before you start. Official Documentation

Alternative installation is possible without local dependencies relying on Docker.

Clone the repository

git clone https://github.com/sreerag-hexeam/simple-ecom.git

Switch to the repo folder

cd simple-ecom

Install all the dependencies using composer

composer install

Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env

set APP_URL=

Generate a new application key

php artisan key:generate

set APP_URL=http://localhost:8000

Run the database migrations (Set the database connection in .env before migrating)

php artisan migrate

Run the database seeder and you're done

php artisan db:seed

Note : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

php artisan migrate:refresh


Start the local development server

php artisan serve

