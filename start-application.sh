#!/bin/bash

set -e

OLD_PWD=`pwd`
echo "=> Iniciando aplicacao normativas"

if [ ! -f .env ]; then
	echo "Arquivo .env não existe. Copiando de env.example"
	cp -v env.example .env
fi

echo "=> Carregando configuracoes .env"
source .env

mkdir -p $DUMP_OUTPUT_FOLDER/$DUMP_ELASTIC_FOLDER
mkdir -p $DUMP_OUTPUT_FOLDER/$DUMP_POSTGRESQL_FOLDER
mkdir -p $DUMP_OUTPUT_FOLDER/$DUMP_UPLOAD_FOLDER


if [ "$SEED_DATABASES" == "2" ]; then
	cd $DUMP_OUTPUT_FOLDER/..
	echo "==> Verificando se base já existe" 
	if [ ! -f "master.zip" ]; then
		echo "===> Base não existe. Apagando tudo para dar lugar à base"
                rm -rf *
                wget $DUMP_URL
	else
		echo "===> Não é necessário baixar base"
	fi
	unzip -u master.zip
else
	echo "=> Continuando sem baixar base"
fi

cd $OLD_PWD
echo "=> Criando diretórios de mapeamento de volumes"
if [ ! -d $ELASTIC_DATA_FOLDER ]; then
	mkdir -p $ELASTIC_DATA_FOLDER
fi

if [ ! -d $DB_DATA_FOLDER ]; then
	mkdir -p $DB_DATA_FOLDER
fi

if [ ! -d $UPLOAD_FOLDER ]; then
	mkdir -p $UPLOAD_FOLDER
fi

docker-compose up --build $*
