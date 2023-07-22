up:
	./vendor/bin/sail up
docker-connect-php:
	docker exec -it v10_php bash
docker-connect-mysql:
	docker exec -it v10_mysql bash
docker-connect-redis:
	docker exec -it v10_mysql redis
docker-migrate:
	./vendor/bin/sail artisan migrate
docker-refresh:
	./vendor/bin/sail artisan migrate:refresh --seed
docker-seed:
	./vendor/bin/sail artisan migrate db:seed
docker-fix:
	docker exec -it v10_php ./vendor/bin/phpcbf -w app/
docker-dev:
	docker exec -it v10_php npm run dev

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

