#!/bin/sh
# wait-for-postgres.sh

set -e
cmd="$@"

while :; do
  curl -sS --fail -o /dev/null "http://normativaselasticsearch:9200/_cat/health?h=st" && break
  echo "ElasticSearch is unavailable - sleeping"
  sleep 1 # actually give your server a little rest
done

echo "<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<--------"
echo "ElasticSearch is up - executing command"

exec $cmd

