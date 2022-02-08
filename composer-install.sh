#!/bin/bash
docker exec -it app.backend composer install
docker exec -it app.frontend composer install