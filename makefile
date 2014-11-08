tests:
	@vendor/bin/phpunit --strict

phpcs:
	@vendor/bin/phpcs --standard=PSR2 src tests

.PHONY: tests phpcs
