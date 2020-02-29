.PHONY: up down nginx php phplog nginxlog db coverage vendor

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))
CONTAINERS := $(shell docker ps -a -q -f "name=glu*")

db:
	docker-compose exec mysql mysql -e 'DROP DATABASE IF EXISTS rfilipov ; CREATE DATABASE rfilipov;'
	docker-compose exec mysql sh -c "mysql rfilipov < docker-entrypoint-initdb.d/database.sql"

coverage:
	docker-compose exec php-fpm sh -c "./vendor/bin/phpunit --coverage-text --coverage-html coverage"

vendor:
	docker-compose exec php-fpm sh -c "composer install"

up:
	docker-compose up -d --build

down:
	docker-compose down

nginx:
	docker exec -it glu-nginx-container bash

php: 
	docker exec -it glu-php-container bash

phplog: 
	docker logs glu-php-container

nginxlog:
	docker logs glu-nginx-container
