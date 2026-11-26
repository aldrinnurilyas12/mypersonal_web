FROM php:8.2-apache

RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql zip gd

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN php artisan storage:link

# Set permission yang benar
RUN chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R 755 storage bootstrap/cache public

# Set Apache DocumentRoot ke public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
# Izinkan .htaccess override

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
