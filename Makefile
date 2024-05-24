setup:
	@docker-compose up -d --build
	@sleep 15
	@docker-compose exec app composer install
	@docker-compose exec app php db.php

test:
	@docker-compose exec app vendor/bin/phpunit

down:
	@docker-compose down
