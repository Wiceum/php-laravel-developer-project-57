install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

test:
	composer exec phpunit tests

coverage_test:
	composer exec --verbose phpunit tests -- --coverage-text

check: validate lint coverage_test
