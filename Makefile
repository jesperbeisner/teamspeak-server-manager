.PHONY: help
help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

run: ## Runs CS-Fixer, PHPUnit and PHPStan
	docker compose up

phpstan: ## Runs PHPStan
	docker compose exec php vendor/bin/phpstan
