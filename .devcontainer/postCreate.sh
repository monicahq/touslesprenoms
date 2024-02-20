#!/bin/bash

DATABASE=database/database.sqlite

SELF_PATH=$(cd -P -- "$(dirname -- "$0")" && /bin/pwd -P)
source $SELF_PATH/../scripts/realpath.sh
ROOT=$(realpath $SELF_PATH/..)

setenv() {
    sed -i "s%$1=.*%$1=$2%" $ROOT/.env
}

set_apache() {
    chgrp -R www-data $ROOT/storage && chmod -R g+w $ROOT/storage
    sudo rm -rf /var/www/html && sudo ln -s "$ROOT/public" /var/www/html
    sudo a2enmod rewrite
    sudo apache2ctl restart
}

set_database() {
    cp $ROOT/.env.example $ROOT/.env && echo "APP_TRUSTED_PROXIES=*" >> $ROOT/.env
    setenv "DB_CONNECTION" "sqlite"
    setenv "DB_DATABASE" "$ROOT/$DATABASE"
    touch $ROOT/$DATABASE && chgrp www-data database $ROOT/$DATABASE && chmod g+w database $ROOT/$DATABASE
}

set_conf() {
    setenv "CACHE_DRIVER" "file"
    setenv "QUEUE_CONNECTION" "sync"
    setenv "SESSION_DRIVER" "database"
    setenv "MAIL_MAILER" "log"
    setenv "MAIL_FROM_ADDRESS" "from@mail.com"
    setenv "MAIL_REPLY_TO_ADDRESS" "reply@mail.com"
}

composer_install() {
    composer install --no-progress --no-interaction --prefer-dist --optimize-autoloader --working-dir=$ROOT
}

yarn_install() {
    yarn install --cwd $ROOT --immutable
    yarn run --cwd $ROOT build
}

setup() {
    php $ROOT/artisan key:generate --no-interaction
    php $ROOT/artisan setup --force -vvv
}

set_apache
set_database
set_conf
composer_install
setup
yarn_install