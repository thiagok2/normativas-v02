#!/bin/bash

echo "=================>>> app-entrypoint.sh"

php artisan key:generate

composer install

if [ "$SEED_DATABASES" != "0" ]; then
	echo "EXECUTANDO DROP na base anterior"
	PGPASSWORD="$POSTGRES_PASSWORD" dropdb -h normativasdb -U "$POSTGRES_USER" --if-exists $POSTGRES_DB
	PGPASSWORD="$POSTGRES_PASSWORD" createdb -h normativasdb -U "$POSTGRES_USER" $POSTGRES_DB

	echo "Excluindo índice normativas"
	curl -XDELETE http://normativaselasticsearch:9200/normativas

	echo "Excluindo arquivos de upload"
	rm -rfv /app/storage/app/public/uploads/*
fi

if [ "$SEED_DATABASES" == "1" ]; then
        echo "EXECUTANDO php artisan migrate"
        php artisan migrate

        echo "EXECUTANDO php artisan db:seed"
        php artisan db:seed

	 echo "EXECUTANDO sh elasticseed/elasticseed.sh"
        sh elasticsearch/seed.sh $6 $7
fi

if [ "$SEED_DATABASES" == "2" ]; then
	echo "Aplicando dump do postgresql.sql"
	echo "/backup/$DUMP_POSTGRESQL_FILE"
	PGPASSWORD=$POSTGRES_PASSWORD psql -h normativasdb -U $POSTGRES_USER -d $POSTGRES_DB -1 -f /backup/$DUMP_POSTGRESQL_FILE

	echo "Copiando PDFs para diretorio de destino"
	cp -v /backup/$DUMP_UPLOAD_FOLDER/* /app/storage/app/public/uploads

	echo "Criando repositorio normativas"
	curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/create-elastic-repo-bck.json http://normativaselasticsearch:9200/_snapshot/normativas

	echo "Restaurando backup elastic"
	curl -XPOST http://normativaselasticsearch:9200/_snapshot/normativas/dump/_restore
fi
