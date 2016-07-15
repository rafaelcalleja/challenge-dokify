#!/bin/bash
set -e
cd /var/www/html;

app/console doctrine:database:create -n -q || echo "Database exists"
app/console doctrine:schema:update -n --force || echo "Update scheme failed"
/mysql-setup.sh || echo "error while import mysql triggers"
app/console hautelook_alice:doctrine:fixtures:load  -n || echo "Fixture load Failed"
app/console fos:user:create --super-admin admin example@example.es admin || "Create default user failed"

