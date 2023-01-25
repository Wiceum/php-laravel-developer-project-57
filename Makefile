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

check: validate lint test

deploy:
	printenv && touch /app/database/database.sqlite && composer install && php artisan optimize && php artisan config:cache && php artisan view:cache && php artisan migrate --force --seed && npm run production
