composer install
composer require laravolt/indonesia
php artisan key:generate
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"
php artisan migrate
php artisan laravolt:indonesia:seed