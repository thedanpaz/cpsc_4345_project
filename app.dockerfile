FROM php:7.2.5-fpm

RUN apt-get update && apt-get install --no-install-recommends -y \
        less

ARG WITH_XDEBUG=false
ARG XDEBUG_TRIGGER_PROFILER=false
ARG XDEBUG_PROFILER_DIR=/var/xdebug

RUN if [ ${WITH_XDEBUG} = "true" ] ; then \
        pecl install xdebug; \
        docker-php-ext-enable xdebug; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        if [ ${XDEBUG_TRIGGER_PROFILER} = "true" ] ; then \
            echo xdebug.profiler_enable_trigger=1 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
            echo xdebug.profiler_output_dir=${XDEBUG_PROFILER_DIR} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        fi ; \
    fi ;

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    mysql-client libmagickwand-dev ghostscript --no-install-recommends \
    imagemagick \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install zip

ARG TIMEZONE=America/Chicago
RUN touch /usr/local/etc/php/conf.d/dates.ini \
    && echo "date.timezone = $TIMEZONE;" >> /usr/local/etc/php/conf.d/dates.ini

RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && echo $TIMEZONE > /etc/timezone

ARG PHP_MEMORY_LIMIT=128M
RUN touch /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo "memory_limit = $PHP_MEMORY_LIMIT" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

ARG PHP_POST_MAX_SIZE=8M
ARG PHP_UPLOAD_MAX_FILESIZE=80M
RUN touch /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "post_max_size = $PHP_POST_MAX_SIZE" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "upload_max_filesize = $PHP_UPLOAD_MAX_FILESIZE" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini

RUN apt-get update && apt-get install -y
RUN chown -R www-data:www-data /var/www
