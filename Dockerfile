FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    nodejs \
    npm \
    curl \
    zip \
    unzip \
    git \
    oniguruma-dev \
    libxml2-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Install PHP extensions
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Create storage directory structure
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install and build frontend
RUN npm install && npm run build && rm -rf node_modules

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy nginx config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Copy supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port
EXPOSE 8080

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
