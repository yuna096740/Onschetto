FROM php:8.2-fpm
# # Docker外にいるブラウザから、appサーバー内にいるViteが見えるようにする
EXPOSE 5173
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libfontconfig1 \
    libxrender1

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pdo_mysql mysqli exif
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

ENV NODE_VERSION=16.16.0
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

WORKDIR /src
ADD . /src/storage
RUN chown -R www-data:www-data /src/storage
# 自動実行用(動作高速化を図り/src/node_modulesフォルダ,/src/vendorフォルダはボリュームマウントから外している為)
# ('--build'オプション) 'docker compose up -d --build', 'docker compose exec onschetto-app bash' で自動実行
ENTRYPOINT [ "bash", "-c", "composer install; npm install; exec php-fpm" ]
