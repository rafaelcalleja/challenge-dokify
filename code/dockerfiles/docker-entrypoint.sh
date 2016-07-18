#!/bin/bash
BBDD=${MYSQL_BBDD:-mydb}
USER=${MYSQL_USER:-admin}
PASS=${MYSQL_PASSWORD:-admin}
ROOTPASS=${MYSQL_ROOT_PASSWORD:-password}
RET=1
while [[ RET -ne 0 ]]; do
    echo "=> Waiting for confirmation of MySQL service startup"
    sleep 5
    mysql -u$USER -p$PASS -hdb -e "status" > /dev/null 2>&1
    RET=$?
done
mysql -uroot -p$ROOTPASS -hdb -e "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"

mv /var/www/html/src/AppBundle/Resources/config/doctrine/CustomList.orm.yml /CustomList.orm.yml
UPDATE=$(/var/www/html/app/console doctrine:schema:update -n);

if [[ $UPDATE != "Nothing to update - your database is already in sync with the current entity metadata." ]]; then
    echo "=> An empty or uninitialized MySQL volume is detected in $VOLUME_HOME"
    echo "=> Installing MySQL ..."
    echo "=> Done!"
    /symfony-bootstrap.sh
else
    echo "=> Using an existing volume of MySQL"
fi

setfacl -R -m u:www-data:rwX -m u:root:rwX /var/www/html/app/cache/
setfacl -dR -m u:www-data:rwX -m u:root:rwX /var/www/html/app/cache/
setfacl -R -m u:www-data:rwX -m u:root:rwX /var/www/html/app/logs/
setfacl -dR -m u:www-data:rwX -m u:root:rwX /var/www/html/app/logs/
mv /CustomList.orm.yml /var/www/html/src/AppBundle/Resources/config/doctrine/CustomList.orm.yml
composer dokify-cmd

exec "$@"
