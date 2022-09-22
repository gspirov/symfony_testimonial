chmod +x ./wait-for-it.sh
chmod +x ./api/docker/php/entrypoint.sh
chmod +x ./admin/docker/php/entrypoint.sh

cd ./api \
&& docker compose --env-file ./docker/.env up -d --force-recreate \
&& docker exec php-api sh -c "./wait-for-it.sh db:5432 -t 30 -- bin/console d:m:m"
#cd ../api && docker compose --env-file ./docker/.env up -d --force-recreate