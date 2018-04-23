FROM alpine

RUN apk update

ADD ./public /var/www

CMD ["slim", "/var/www/index.php"]