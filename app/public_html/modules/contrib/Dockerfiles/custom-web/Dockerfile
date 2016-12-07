FROM droptica/drupal-apache:7-xdebug

RUN docker-php-ext-install bcmath

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*