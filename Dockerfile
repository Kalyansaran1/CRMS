# Use official PHP with Apache
FROM php:8.1-apache

# Copy all project files to Apache server root
COPY . /var/www/html/

# Enable Apache rewrite module (optional but useful)
RUN a2enmod rewrite

# Expose port 80 (standard web traffic)
EXPOSE 80

FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli



