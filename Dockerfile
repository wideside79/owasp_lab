FROM php:8.1-apache

COPY vuln-webapp/ /var/www/html/

RUN a2enmod rewrite

EXPOSE 80
