docker-connect-php:
	docker exec -it redance_php bash
docker-connect-mysql:
	docker exec -it redance_mysql bash
docker-connect-redis:
	docker exec -it redance_mysql redis
docker-migrate:
	docker exec -it redance_php php artisan migrate
docker-db-refresh:
	docker exec -it redance_php php artisan migrate:refresh --seed
docker-seed:
	docker exec -it redance_php php artisan migrate db:seed
docker-fix:
	docker exec -it redance_php ./vendor/bin/phpcbf -w app/
docker-dev:
	docker exec -it redance_php npm run dev

migrate:
	php artisan migrate
migrate-refresh:
	php artisan migrate:refresh --seed
seed:
	php artisan migrate db:seed
fix:
	./vendor/bin/phpcbf -w app/
dev:
	npm run dev

