FROM php:7.4-zts-buster

# Start Node.js installation
COPY --from=node:12-stretch /usr/local/bin/node /usr/local/bin/node
COPY --from=node:12-stretch "/opt/yarn-v*" /opt/yarn

RUN ln -s /usr/local/bin/node /usr/local/bin/nodejs \
  && ln -s /opt/yarn/bin/yarn /usr/local/bin/yarn \
  && ln -s /opt/yarn/bin/yarnpkg /usr/local/bin/yarnpkg

ENV PATH="$(yarn global bin):$PATH"
# End Node.js Installation

# Start Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# End Composer installation

# Start Project dependencies installation
RUN apt-get update -qq \
  && apt-get install -qq --no-install-recommends \
  git \
  zip \
  unzip \
  libzip-dev \
  && docker-php-ext-install \
  zip \
  && apt-get clean
# End Project dependencies installation

# Start creation of non-root user
ARG UID=1000
ARG GID=1000

RUN groupmod -g ${GID} www-data \
  && usermod -u ${UID} -g www-data www-data \
  && mkdir -p /var/app \
  && chown -hR www-data:www-data \
  /var/www \
  /var/app \
  /usr/local/

USER www-data:www-data
# End creation of non-root user

WORKDIR /var/app
EXPOSE 3000
