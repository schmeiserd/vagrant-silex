#!/usr/bin/env bash

echo "Start provision"

sudo apt-get update

echo "### install vim ###"
sudo apt-get install -y vim

echo "### install apache ###"
apt-get install -y apache2

echo "### config apache ###"
sudo a2enmod rewrite
sudo cp /home/vagrant/provision/apache_config /etc/apache2/sites-available/000-default.conf

echo "### install php ###"
sudo apt-get install -y php5 php-pear php5-dev php5-gd php5-curl php5-mcrypt php5-xdebug php5-mysql

echo "### config xdebug ###"
sudo pecl install xdebug
sudo cp /home/vagrant/provision/xdebug.ini /etc/php5/mods-available/xdebug.ini

sudo service apache2 restart

echo "### install mysql ###"
sudo apt-get install debconf-utils -y
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password 1234"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password 1234"

sudo apt-get install mysql-server -y

echo "### install bower ###"
sudo apt-get install curl -y
sudo apt-get install npm -y
sudo apt-get install git -y
sudo npm config set registry http://registry.npmjs.org/
sudo npm install -g n
sudo n stable
sudo npm install -g bower

echo "### set up project ###"
cd /var/www/
bower update --allow-root
curl -sS https://getcomposer.org/installer | php
php composer.phar update
echo "# bootstrap.sql #"
mysql < sql/bootstrap.sql -u root -p1234
echo "# datadefinition.sql #"
mysql < sql/datadefinition.sql -u root -p1234
echo "# datamanipulation.sql #"
mysql < sql/datamanipulation.sql -u root -p1234

echo "Finished provision"
echo "Go ahead!"