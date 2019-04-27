FROM php:7.3.1-apache
MAINTAINER scamp <sander_camp@live.nl>

# Set the public folder as the apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable the apache mod_rewrite module
RUN a2enmod rewrite

# Add www-data to the dialout group to give it access to ttyUSB0
RUN usermod -a -G dialout www-data

# Set the baud rate for ttyUSB0
# RUN stty -F /dev/ttyUSB0 115200 

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y curl && \
    apt-get install -y libzip-dev
    
# Install php extensions
RUN docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install zip

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g yarn

# Configure alias for composer
RUN echo 'alias composer="php /usr/local/bin/composer"' >> ~/.bash_profile
