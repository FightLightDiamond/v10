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
docker-queue:
	./vendor/bin/sail artisan queue:work
docker-fix:
	docker exec -it v10_php ./vendor/bin/phpcbf -w app/
docker-dev:
	docker exec -it v10_php npm run dev

migrate:
	php artisan migrate
refresh:
	php artisan migrate:refresh --seed
seed:
	php artisan migrate db:seed
fix:
	./vendor/bin/phpcbf -w app/
dev:
	npm run dev
start:
	php artisan octane:start
echo:
	laravel-echo-server start
pm2:
	pm2 start processes.yaml

swarm:
	docker swarm init && docker stack deploy -c swarm-docker-compose.yml laravel-stack

leave:
	docker swarm leave --force
