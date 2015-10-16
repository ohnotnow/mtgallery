## Gallery & Blog code for my hobby website

This is the code I use to run my hobby website.  It's written in PHP and uses
the [Laravel](http://laravel.com/) framework.  There isn't much in the way
of validation/error-checking etc as it's "just for me".

If you do want to try the code out, clone the repo then do :

1. `composer install`
2. `mv .env.example .env`
3. Edit .env to suit your setup
4. `php artisan key:generate`
5. `php artisan migrate`
6. `chown -R www-data storage bootstrap/cache public/mt_images`
7. `php artisan mtgallery:createadmin your@emailaddress.com`
8. Browse to your site and log in at /admin/ to start creating galleries etc

