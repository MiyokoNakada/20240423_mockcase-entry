FROM php:8.2.12-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip
  && apt install -y cron

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

RUN ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

COPY start-scheduler.sh /usr/local/bin/start-scheduler.sh
RUN chmod +x /usr/local/bin/start-scheduler.sh
#start-scheduler.shの内容： php /var/www/artisan schedule:work
COPY crontab /etc/cron.d/laravel-scheduler
#crontabの内容：* * * * * root /usr/local/bin/start-scheduler.sh > /dev/null 2>&1
RUN service cron start


WORKDIR /var/www