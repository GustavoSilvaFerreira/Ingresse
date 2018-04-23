FROM php:7-alpine

ADD ./public /var/www

CMD ["slim", "/var/www/index.php"]