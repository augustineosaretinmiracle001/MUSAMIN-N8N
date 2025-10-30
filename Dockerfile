FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    nginx \
    supervisor \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    mysql-client

# Configure GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code first
COPY . .

# Install PHP dependencies
RUN composer install --no-scripts --no-interaction

# Install Node dependencies
RUN npm ci

# Build frontend assets
RUN npm run build

# Create .env file from environment variables
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_KEY=base64:ioxbXKw7LniLXzvrK7aTPulZ4XtlLx2mbcmyGo50CjA=" >> .env && \
    echo "APP_URL=https://musamin.app" >> .env && \
    echo "DB_CONNECTION=mysql" >> .env && \
    echo "DB_HOST=mysql" >> .env && \
    echo "DB_PORT=3306" >> .env && \
    echo "DB_DATABASE=default" >> .env && \
    echo "DB_USERNAME=mysql" >> .env && \
    echo "DB_PASSWORD=Musamin@70" >> .env

# Run Laravel setup commands
RUN php artisan config:clear || true

# Clean up Node dependencies
RUN npm prune --production && npm cache clean --force

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create necessary directories
RUN mkdir -p /var/log/supervisor /var/log/nginx

# Expose port
EXPOSE 80

# Create startup script
RUN echo '#!/bin/sh' > /startup.sh && \
    echo 'echo "Waiting for database..."' >> /startup.sh && \
    echo 'sleep 10' >> /startup.sh && \
    echo 'php artisan migrate --force' >> /startup.sh && \
    echo 'exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' >> /startup.sh && \
    chmod +x /startup.sh

# Start with migration
CMD ["/startup.sh"]