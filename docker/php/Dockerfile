FROM php:8.3-fpm
WORKDIR /var/www/symfony_app

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        zlib1g-dev \
        libzip-dev \
        libicu-dev \
        libpq-dev \
        && docker-php-ext-install pdo pdo_mysql zip intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug-3.4.0 && docker-php-ext-enable xdebug

# COPY --chown=www-data:www-data . /var/www/symfony_app

# RUN chown -R www-data:www-data /var/www/symfony_app

# non-root user.
ARG USER_ID=1000
ARG GROUP_ID=1000

RUN chown -R ${USER_ID}:${GROUP_ID} /var/www/symfony_app
COPY --chown=${USER_ID}:${GROUP_ID} . /var/www/symfony_app

RUN groupmod -g ${GROUP_ID} www-data && \
    usermod -u ${USER_ID} www-data

USER "${USER_ID}:${GROUP_ID}"

USER www-data

CMD ["php-fpm"]
