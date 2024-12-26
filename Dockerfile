FROM alpine:latest

RUN apk add -U tzdata
ENV TZ=America/Sao_Paulo
RUN cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime
RUN apk add --no-cache zip unzip curl bash nginx nodejs npm

RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

RUN apk add php82 \
        php82-common \
        php82-fpm \
        php82-pdo \
        php82-opcache \
        php82-zip \
        php82-phar \
        php82-iconv \
        php82-cli \
        php82-curl \
        php82-pdo_mysql \
        php82-mysqli \
        php82-openssl \
        php82-mbstring \
        php82-tokenizer \
        php82-fileinfo \
        php82-json \
        php82-gd \
        php82-dom \
        php82-session \
        php82-pcntl \
        php82-ftp \
        php82-xml \
        php82-simplexml \
        php82-xmlwriter \
        php82-pecl-imagick \
        php82-xmlreader \
        php82-posix \
        php82-redis

RUN ln -s /usr/bin/php82 /usr/bin/php

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
        && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
        && rm -rf composer-setup.php

COPY ./docker/php/www.conf /etc/php82/php-fpm.d/www.conf

WORKDIR /app
COPY . /app
RUN composer update
RUN composer install

RUN php artisan key:generate
#        && php artisan jwt:secret\
#        && php artisan cache:clear \
#        && php artisan route:clear\
#        && php artisan optimize\
#        && php artisan config:clear

RUN touch /app/storage/logs/laravel.log
RUN chmod 777 -R /app/storage bootstrap/cache
RUN chown -R nginx:nginx /app

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/app.conf /etc/nginx/conf.d/app.conf

COPY ./docker/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
