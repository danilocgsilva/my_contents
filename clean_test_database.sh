#!/bin/bash

set -e

docker exec -it my_contents_db mysql -uroot -pmyverystrongpassword -e "DROP DATABASE my_contents_test;"
docker exec -it my_contents_db mysql -uroot -pmyverystrongpassword -e "CREATE DATABASE my_contents_test;"
docker exec -it my_contents php artisan migrate --env=testing
