# README #

To use this you have to have docker-drupal installed on your system
https://bitbucket.org/droptica/docker-drupal

clone repo and check out branch for your drupal version eg. D7

run "drupal-docker init"

edit docker-compose.yml if you need changes

put your drupal into /app

run "docker-drupal up" to get all dockers


put your database to databases/database.sql.tar.gz

run "drupal-docker build" to build your website

... code away