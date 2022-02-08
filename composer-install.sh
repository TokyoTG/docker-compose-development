#!/bin/bash
docker exec -it app.backend composer install
docker exec -it app.frontend composer install
docker exec -it app.frontend chmod -R 777 /var/www/storage
docker exec -it app.backend chmod -R 777 /var/www/storage