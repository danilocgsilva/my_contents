FROM php:8.5.5-apache-trixie

RUN apt-get update
RUN apt-get upgrade -y
# RUN apt-get install curl git zip -y
RUN apt-get install zip -y
RUN docker-php-ext-install mysqli pdo pdo_mysql
# RUN apt-get install php-mysql -y
# RUN apt-get install php php-mysql php-xdebug php-curl php-zip php-xml php-mbstring -y
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
# RUN pecl install mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
# RUN apt-get install mariadb-client -y
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - 
RUN apt install -y nodejs
# COPY /config/xdebug.ini /etc/php/8.2/mods-available/
# COPY /config/startup.sh /startup.sh
# COPY /config/apache2.conf /etc/apache2/
RUN a2enmod rewrite headers
COPY /config/000-default.conf /etc/apache2/sites-available/
# COPY /config/php.ini /etc/php/8.2/apache2/
# RUN chmod +x /startup.sh

# CMD sh /startup.sh
# CMD while : ; do sleep 1000; done
CMD ["apache2-foreground"]