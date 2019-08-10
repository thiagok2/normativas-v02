#!/bin/bash

set -e

OLD_PWD=`pwd`
echo "=> Iniciando aplicacao normativas"
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
if [ ! -f $ELASTIC_DATA_FOLDER ]; then
	mkdir -p $ELASTIC_DATA_FOLDER
fi

if [ ! -f $DB_DATA_FOLDER ]; then
	mkdir -p $DB_DATA_FOLDER
fi

if [ ! -f $UPLOAD_FOLDER ]; then
	mkdir -p $UPLOAD_FOLDER
fi

docker-compose up --build $*
