FROM php:8.2-cli

ARG USER=teamspeak-manager
ARG UID=1000

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive
# RUN apt-get update && apt-get -y upgrade && apt-get -y install --no-install-recommends && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get -y upgrade

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions swoole @composer

RUN useradd --create-home --shell /bin/bash -U $USER -u $UID
USER $USER

CMD ["php", "public/index.php"]
