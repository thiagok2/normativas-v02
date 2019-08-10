#!/bin/sh
# wait-for-postgres.sh

set -e
cmd="$@"

until PGPASSWORD="${POSTGRES_PASSWORD}" psql -h "normativasdb" -U "${POSTGRES_USER}" -c '\q'; do
  >&2 echo "Postgres is unavailable - sleeping"
  echo "Executando => PGPASSWORD=\"${POSTGRES_PASSWORD}\" psql -h "normativasdb" -U \"${POSTGRES_USER}\" -c '\q'"
  sleep 1
done

>&2 echo "Postgres is up - executing command"

exec $cmd

