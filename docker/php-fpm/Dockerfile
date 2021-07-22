FROM php:7.4-fpm

# Chromium and ChromeDriver
ENV PANTHER_NO_SANDBOX 1
# Not mandatory, but recommended
ENV PANTHER_CHROME_ARGUMENTS='--disable-dev-shm-usage'

RUN apt-get update && apt-get install -y wget gnupg2
RUN wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add -
RUN sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list'

RUN apt-get update && apt-get install -y google-chrome-stable \
    && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev zlib1g-dev libicu-dev g++ libxml2-dev \
     git zip libzip-dev
RUN docker-php-ext-install opcache
RUN docker-php-ext-configure zip && docker-php-ext-install zip
RUN docker-php-ext-enable zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY overrides.conf /etc/php/7.4/fpm/pool.d/z-overrides.conf
ADD php-ini-overrides.ini /etc/php/7.4/fpm/conf.d/99-overrides.ini
COPY entrypoint.sh /etc/entrypoint.sh

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]