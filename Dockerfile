#Image based on ubuntu 15.10
FROM ubuntu:15.10

# Define maintainer
MAINTAINER Alejandro Scott <ascott@devspark.com>

# Update repositories
RUN apt-get update && apt-get -y upgrade
# Install neccesary packages
RUN apt-get -y install apache2 \ 
						libapache2-mod-php5 \ 
						php5-mysql \ 
						php5-gd \ 
						php-pear \ 
						php-apc \ 
						php5-curl \ 
						curl \ 
						lynx-cur

# Actvate several modules
RUN a2enmod php5
RUN a2enmod rewrite

# Define environment vars
# Apache vars
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Api vars
ENV WORLD_API_DOCUMENT_ROOT /opt/www/worldapi/public/
ENV WORLD_API_SERVER_NAME api.world.com.ar

# Expose main ports
EXPOSE 80

# Copy apache configuration
COPY apache2.conf /etc/apache2/apache2.conf

# Copy virtual host configuration
COPY worldapi.conf /etc/apache2/sites-available/worldapi.conf

# Enable virtual host
RUN a2ensite worldapi

# Copy bash for entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

# Execute default command
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
