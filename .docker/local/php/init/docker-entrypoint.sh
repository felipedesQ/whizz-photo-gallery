#!/bin/bash

set -e

sleep 15

# Build cache
php /whizz-photo-gallery/bin/console cache:clear --no-warmup --env=test
php /whizz-photo-gallery/bin/console cache:warmup --env=test

php /whizz-photo-gallery/bin/console doctrine:migrations:migrate --env=test --no-interaction --allow-no-migration

echo "Migrations executed successfully."

exec "$@"
