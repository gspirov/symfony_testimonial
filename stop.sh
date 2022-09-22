cd ./admin && docker compose --env-file ./docker/.env down --rmi all
cd ../api && docker compose --env-file ./docker/.env down --rmi all