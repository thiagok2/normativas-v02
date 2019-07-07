#!/bin/bash

echo "=================>>> app-entrypoint.sh"
SEED_DATABASES=$1
POSTGRES_PASSWORD=$2
DB_HOST=$3
POSTGRES_USER=$4
POSTGRES_DB=$5

echo "SEED_DATABASES: $SEED_DATABASES"
echo "POSTGRES_PASSWORD: $POSTGRES_PASSWORD"
echo "DB_HOST: $DB_HOST"
echo "POSTGRES_USER: $POSTGRES_USER"
echo "POSTGRES_DB: $POSTGRES_DB"

php artisan key:generate

composer install

if [ "$SEED_DATABASES" = "1" ]; then
	echo "EXECUTANDO DROP na base anterior"
	PGPASSWORD="$POSTGRES_PASSWORD" dropdb -h "$DB_HOST" -U "$POSTGRES_USER" --if-exists $POSTGRES_DB
	PGPASSWORD="$POSTGRES_PASSWORD" createdb -h "$DB_HOST" -U "$POSTGRES_USER" $POSTGRES_DB
	
	echo "EXECUTANDO php artisan migrate"
	php artisan migrate

	echo "EXECUTANDO php artisan db:seed"	
	php artisan db:seed


	echo "EXECUTANDO sh elasticseed/elasticseed.sh"
	sh elasticsearch/seed.sh $6 $7
fi

