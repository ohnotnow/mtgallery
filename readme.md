## Gallery & Blog code for my hobby website

NB. This is a work in progress.

This is the code I use to run my hobby website.  It's written in PHP and uses
the [Laravel](http://laravel.com/) framework.  There isn't much in the way
of validation/error-checking etc as it's "just for me".

If you do want to try the code out, clone the repo then do :

1. `composer install`
2. `mv .env.example .env`
3. Edit .env to suit your setup
4. `mkdir public/uploaded_images` (or whatever you set in .env)
5. `php artisan key:generate`
6. `php artisan migrate`
7. `chown -R www-data storage bootstrap/cache public/uploaded_images`
8. `php artisan mtgallery:createadmin your@emailaddress.com`
9. Browse to your site and log in at /admin/ to start creating galleries etc

