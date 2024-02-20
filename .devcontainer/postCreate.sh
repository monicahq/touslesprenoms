#!/bin/bash

DATABASE=database/database.sqlite

realpath ()
{
    f=$@;
    if [ -z "$f" ]; then
      f=$(pwd)
    fi
    if [ -d "$f" ]; then
        base="";
        dir="$f";
    else
        base="/$(basename "$f")";
        dir=$(dirname "$f");
    fi;
    dir=$(cd "$dir" && /bin/pwd -P);
    echo "$dir$base"
}

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
    touch $ROOT/$DATABASE && chgrp www-data $ROOT/$DATABASE && chmod g+w $ROOT/$DATABASE
}

set_conf() {
    setenv "CACHE_DRIVER" "file"
    setenv "QUEUE_CONNECTION" "sync"
    setenv "SESSION_DRIVER" "database"
    setenv "MAIL_MAILER" "log"
    setenv "MAIL_FROM_ADDRESS" "from@mail.com"
    setenv "MAIL_REPLY_TO_ADDRESS" "reply@mail.com"
    setenv "APP_URL" "https://${CODESPACE_NAME}-8080.${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN}"
}

composer_install() {
    composer install --no-progress --no-interaction --prefer-dist --optimize-autoloader --working-dir=$ROOT
}

yarn_install() {
    yarn --cwd $ROOT install --immutable
    yarn --cwd $ROOT run build
}

setup() {
    php $ROOT/artisan key:generate --no-interaction
    php $ROOT/artisan setup --force -vvv
}

SELF_PATH=$(cd -P -- "$(dirname -- "$0")" && /bin/pwd -P)
ROOT=$(realpath $SELF_PATH/..)

set_apache
set_database
set_conf
composer_install
setup
yarn_install
