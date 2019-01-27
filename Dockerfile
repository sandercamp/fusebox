FROM php:7.3.1-apache
MAINTAINER scamp <sander_camp@live.nl>

RUN usermod -a -G dialout www-data
