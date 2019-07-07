#!/bin/sh
# wait-for-postgres.sh

set -e

host="$1"
port="$2"
echo "INVOCANDO $host"
echo "INVOCANDO $port"
shift 2
cmd="$@ $host $port"
echo "===========================+>>>>>>>>>>>>>>>>>>>"

while :; do
  echo "Testando Elasticsearch!!!"
  curl -sS --fail -o /dev/null "http://${host}:${port}/_cat/health?h=st" && break
  echo "ElasticSearch is unavailable - sleeping"
  sleep 1 # actually give your server a little rest
done

echo "<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<--------"
echo "ElasticSearch is up - executing command"

exec $cmd

