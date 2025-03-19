# Use the official PHP image with Apache
FROM php:7.4-apache

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Copy the custom Apache vhost file into the container
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set our application folder as an environment variable
ENV APP_HOME /var/www/html

# Set working directory in container
WORKDIR $APP_HOME

# Copy your Laravel application into the container
COPY . $APP_HOME

# Install the Laravel PHP dependencies
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME

# Change ownership of our applications
RUN chmod 777 $APP_HOME

# Expose port 80
EXPOSE 80

# Run migrations and seeding, and then start the apache2-foreground
CMD php artisan migrate --force --seed &&  apache2-foreground
