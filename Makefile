$(shell cp -n .env.example .env)
include .env
.DEFAULT_GOAL := help

DOCKER = docker
COMPOSE = docker compose
DOCKER_RUN = $(COMPOSE) run -u $$(id -u):$$(id -g) --rm
DOCKER_EXEC = $(COMPOSE) exec -u $$(id -u):$$(id -g)

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

console-php: ## Run php bash
	$(DOCKER_EXEC) php-fpm sh

docs: ## Update openapi docs
	$(DOCKER_EXEC) php-fpm ./yii docs

unit-test: ## Run PHPUnit tests
	$(DOCKER_EXEC) php-fpm ./vendor/bin/phpunit --testdox tests

composer-command: ## Composer command c="some command"
	$(DOCKER_RUN) composer $(c)

composer-install: ## Composer install command
	$(DOCKER_RUN) composer composer install -o

composer-dumpautoload: ## Composer dump autoload
	$(DOCKER_RUN) composer dumpautoload -o

db-reset: ## Remove db volume
	$(DOCKER_CMD) 

up: ## Up Docker-project
	$(COMPOSE) up -d

down: ## Down Docker-project
	$(COMPOSE) down --remove-orphans

stop: ## Stop Docker-project
	$(COMPOSE) stop

build: ## Build Docker-project
	$(COMPOSE) build --no-cache

ps: ## Show list containers
	$(COMPOSE) ps

log: ## Show containers logs
	$(COMPOSE) logs -f -n10

default: help
