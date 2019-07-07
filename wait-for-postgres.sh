#!/bin/sh
# wait-for-postgres.sh

set -e

host="$1"
user="$2"
password="$3"
shift 3
cmd="$@ $host $user $password"

until PGPASSWORD="${password}" psql -h "$host" -U "$user" -c '\q'; do
  >&2 echo "Postgres is unavailable - sleeping"
  echo "Executando => PGPASSWORD=\"${password}\" psql -h "$host" -U \"$user\" -c '\q'"
  sleep 1
done

>&2 echo "Postgres is up - executing command"

exec $cmd

