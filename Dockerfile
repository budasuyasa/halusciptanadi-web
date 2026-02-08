# ============================================================
# Stage: base
# Shared system dependencies, PHP extensions, Composer, Node.js
# ============================================================
FROM php:8.4-apache AS base

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    locales \
    zip \
    libonig-dev \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    ca-certificates \
    vim \
    tmux \
    unzip \
    git \
    supervisor \
    cron \
    curl

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/

# Configure Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set Apache log to stdout/stderr and add ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    sed -i 's|ErrorLog ${APACHE_LOG_DIR}/error.log|ErrorLog /dev/stderr|g' /etc/apache2/apache2.conf && \
    sed -i 's|CustomLog ${APACHE_LOG_DIR}/access.log combined|CustomLog /dev/stdout combined|g' /etc/apache2/apache2.conf

RUN mkdir -p /var/log/apache2 && chown -R www-data:www-data /var/log/apache2
RUN a2enmod rewrite


# ============================================================
# Stage: development (default for local docker-compose)
# ============================================================
FROM base AS development

RUN rm -r /var/www/*

COPY . /var/www/
RUN mkdir /var/www/.composer
COPY docker/php/php.ini /usr/local/etc/php/conf.d/
COPY docker/supervisord.conf /etc/supervisord.conf

ARG USER_ID
ARG GROUP_ID

RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g ${GROUP_ID} www-data &&\
    useradd -l -u ${USER_ID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive \
    --from=33:33 ${USER_ID}:${GROUP_ID} \
    /home/www-data \
    /var/www/ \
    /var/log/supervisor \
    ;fi

RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /var/log/supervisor

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

USER www-data


# ============================================================
# Stage: production
# Self-contained image with all assets baked in
# ============================================================
FROM base AS production

RUN rm -r /var/www/*

# Copy application code
COPY . /var/www/

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --working-dir=/var/www

# Build frontend assets
RUN cd /var/www && npm ci && npm run build && rm -rf node_modules

# Copy production PHP config and supervisor config
COPY docker/php/php-production.ini /usr/local/etc/php/conf.d/php.ini
COPY docker/supervisord.conf /etc/supervisord.conf

# In production, Apache starts as root (binds port 80, drops to www-data for workers)
RUN sed -i '/^\[program:apache2\]/,/^\[/{s/^user=www-data$//}' /etc/supervisord.conf

# Copy production entrypoint
COPY docker/entrypoint-prod.sh /usr/local/bin/entrypoint-prod.sh
RUN chmod +x /usr/local/bin/entrypoint-prod.sh

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /var/log/supervisor

# Create storage and cache directories with proper permissions
RUN mkdir -p /var/www/storage/logs \
    /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

ENTRYPOINT ["/usr/local/bin/entrypoint-prod.sh"]
