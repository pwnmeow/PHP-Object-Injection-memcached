FROM ubuntu:latest
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install php-curl -y
RUN apt-get install -y apache2
RUN apt-get install -y php 
RUN apt-get install -y php-dev 
RUN apt-get install -y php-memcache
RUN apt-get install -y libapache2-mod-php 
RUN apt-get install -y php-curl 
RUN apt-get install -y php-json 
RUN apt-get install -y php-common 
RUN apt-get install -y php-mbstring 
RUN apt-get install -y composer
RUN apt-get install -y memcached
RUN apt-get install -y sudo
RUN apt-get install -y vim.tiny 
COPY starterscripts/ /tmp/starterscripts/
COPY poc/ /var/www/html/
RUN ls -al /var/www/html
RUN chown -R www-data:www-data /var/www/html 
RUN chmod -R 755 /var/www/html
RUN chmod +x /tmp/starterscripts/start.sh
ENTRYPOINT ["/tmp/starterscripts/start.sh"]
RUN a2enmod rewrite
EXPOSE 80
EXPOSE 443
EXPOSE 11211

