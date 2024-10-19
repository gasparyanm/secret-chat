# Use official PHP 8.2 image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Install Node.js (Node 18 instead of Node 17)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Create a new user (e.g., 'appuser')
RUN useradd -ms /bin/bash appuser

# Add 'appuser' to 'www-data' group
RUN usermod -aG www-data appuser

# Switch to the 'appuser'
USER appuser

# Copy existing application directory contents
COPY --chown=appuser:www-data . /var/www

# Change ownership of the application directory to www-data
#RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
