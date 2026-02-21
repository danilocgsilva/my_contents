#!/bin/bash

docker compose up -d --build
echo Creating the development database...
docker exec -it my_contents_db mysql -uroot -pmyverystrongpassword -e "CREATE DATABASE IF NOT EXISTS my_contents;"
echo Creating the test database...
docker exec -it my_contents_db mysql -uroot -pmyverystrongpassword -e "CREATE DATABASE IF NOT EXISTS my_contents_test;"

if [ -f www/.env ]; then
    echo ".env file already exists. Skipping creation."
else
    echo "Creating .env file..."
    cp www/.env.example www/.env
fi

docker exec -it my_contents composer install
docker exec -it my_contents php artisan key:generate
docker exec -it my_contents php artisan migrate
docker exec -it my_contents php artisan migrate --env=testing
