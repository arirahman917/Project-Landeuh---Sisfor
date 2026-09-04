FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd opcache

# Configure custom php.ini settings for large file uploads
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/custom-php.ini && \
    echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/custom-php.ini && \
    echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/custom-php.ini && \
    echo "display_errors = Off" >> /usr/local/etc/php/conf.d/custom-php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/conf.d/custom-php.ini

# Configure opcache for maximum performance
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini && \
    echo "opcache.save_comments=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Install Node.js & npm (for Vite/frontend assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Clear apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable mod_rewrite & set ServerName to suppress AH00558 warning
RUN a2enmod rewrite && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Change document root for Apache to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT="/var/www/html/public"

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy application source code
COPY . /var/www/html

# Make entrypoint script executable
RUN chmod +x /var/www/html/docker-entrypoint.sh

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install NPM dependencies and build frontend assets
RUN npm install && npm run build

# Ensure correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Use custom entrypoint that fixes MPM at runtime before starting Apache
CMD ["/var/www/html/docker-entrypoint.sh"]
