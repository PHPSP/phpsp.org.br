DOCKER_COMPOSE  	= docker-compose
DOCKER_COMPOSE_RUN	= $(DOCKER_COMPOSE) run --rm web

COMPOSER        	= $(DOCKER_COMPOSE_RUN) composer
YARN        		= $(DOCKER_COMPOSE_RUN) yarn

## 
## Basic
## -------
## 
build:
	@$(DOCKER_COMPOSE) pull --parallel --quiet --ignore-pull-failures 2> /dev/null
	$(DOCKER_COMPOSE) build --pull

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

start: ## Start the project (assumes it's already installed)
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project (but won't destroy anything)
	$(DOCKER_COMPOSE) stop

install: ## Install and start the project
install: build  composer-install yarn-install start

reset: ## Destroys and installs a fresh version of the project
reset: kill install

.PHONY: install reset start stop

## 
## Advanced
## -------
## 
composer-install: ## Install PHP dependencies
	$(COMPOSER) install

composer-update: ## Update PHP dependencies
	$(COMPOSER) update

yarn-install: ## Install YARN dependencies
	$(YARN) install


.PHONY: composer-install composer-update yarn-install


.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help