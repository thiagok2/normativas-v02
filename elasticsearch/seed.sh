#/bin/bash

echo "Executando ===> curl --header "Content-Type: application/json" --request PUT --data-binary elasticsearch/01.json http://normativaselasticsearch:9200/_ingest/pipeline/attachment"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/01.json http://normativaselasticsearch:9200/_ingest/pipeline/attachment

echo "Executando ===> curl --request DELETE http://normativaselasticsearch:9200/normativas"
curl --request DELETE http://normativaselasticsearch:9200/normativas

echo "Executando ===> curl --header "Content-Type: application/json" --request PUT --data-binary elasticsearch/03.json http://normativaselasticsearch:9200/normativas"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/03.json http://normativaselasticsearch:9200/normativas

echo "Executando ===> curl --header "Content-Type: application/json" --request POST --data-binary elasticsearch/04.json http://normativaselasticsearch:9200/normativas/_mapping/_doc"
curl --header "Content-Type: application/json" --request PUT --data-binary @elasticsearch/04.json http://normativaselasticsearch:9200/normativas/_mapping/_doc


