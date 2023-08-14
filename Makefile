.PHONY: help
help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

run: ## Runs CS-Fixer, PHPUnit and PHPStan
	docker compose up

phpstan: ## Runs PHPStan
	docker compose exec php vendor/bin/phpstan analyse --memory-limit=-1

phpstan-baseline: ## Runs PHPStan and generates new baseline
	docker compose exec php vendor/bin/phpstan analyse --memory-limit=-1 --generate-baseline=.phpstan/phpstan-baseline.php
