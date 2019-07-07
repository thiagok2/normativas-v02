#/bin/bash

host=$1
port=$2

echo "HOST: $host"
echo "PORT: $port"

echo "Executando ===> curl --header "Content-Type: application/json" --request PUT --data-binary elasticsearch/01.json http://$host:$port/_ingest/pipeline/attachment"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/01.json http://$host:$port/_ingest/pipeline/attachment

echo "Executando ===> curl --request DELETE http://$host:$port/normativas"
curl --request DELETE http://$host:$port/normativas

echo "Executando ===> curl --header "Content-Type: application/json" --request PUT --data-binary elasticsearch/03.json http://$host:$port/normativas"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/03.json http://$host:$port/normativas

echo "Executando ===> curl --header "Content-Type: application/json" --request POST --data-binary elasticsearch/04.json http://$host:$port/normativas/_mapping/_doc"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/04.json http://$host:$port/normativas/_mapping/_doc


