FROM php:8.2-cli-alpine

ARG USER=teamspeak-server-manager
ARG UID=1000

WORKDIR /var/www/html

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions swoole @composer

COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader

RUN adduser --disabled-password --uid $UID $USER
RUN chown -R $USER /var/www/html
USER $USER

CMD ["php", "public/index.php"]
