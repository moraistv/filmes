FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd mysqli pdo_mysql zip \
    && a2enmod rewrite deflate expires headers \
    && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html
COPY docker/php.ini /usr/local/etc/php/conf.d/painel.ini
COPY docker/apache-extra.conf /etc/apache2/conf-enabled/painel-extra.conf
COPY docker/entrypoint.sh /usr/local/bin/painel-entrypoint

# Guarda uma copia "de fabrica" da pasta images/ fora do caminho que sera
# coberto pelo volume persistente. O entrypoint usa essa copia para trazer
# arquivos novos (ex.: logo atualizado) para o volume a cada deploy, sem
# sobrescrever uploads que os usuarios ja fizeram pelo painel.
RUN cp -r /var/www/html/images /var/www/html/images.dist

RUN sed -i 's/\r$//' /usr/local/bin/painel-entrypoint \
    && chmod +x /usr/local/bin/painel-entrypoint \
    && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

ENTRYPOINT ["painel-entrypoint"]
CMD ["apache2-foreground"]

