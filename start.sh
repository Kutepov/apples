composer install
php init --env=Development --overwrite=y
php yii migrate --interactive=0
php yii user/create admin admin &
php-fpm