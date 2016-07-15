#!/usr/bin/env bash

BBDD=${MYSQL_BBDD:-mydb}
USER=${MYSQL_USER:-admin}
PASS=${MYSQL_PASSWORD:-admin}

mysql -u$USER -p$PASS $BBDD -hdb < /triggers.sql
