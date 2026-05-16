FROM php:8.2-apache

<<<<<<< HEAD
#Habilitar la extención de PHP para PDO con MySQL
RUN docker-php-ext-install pdo pdo_mysql

#reemplazar la configuración que viene por defecto en apache2.conf por lo que se en cuentra en el archivo docker/app/apache2.conf
COPY docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf

#activar el módulo de reescritura de Apache
RUN a2enmod rewrite

#Directorio de trabajo base para el proyecto
=======
# Habilitar la extensión de PHP para PDO con MySQL
RUN docker.php-ext-install pdo pdo_mysql

#Remplazar la configuracion que viene por defecto en apache2.conf por la que se encuentra en el proyecto apuntando a /public
COPY docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf

# Activar el módulo de reescritura de Apache
RUN a2enmod rewrite

#Directorio de trabajo base para la aplicación
>>>>>>> d8e9aa004f8b8f856a8e4524a8e68a9393210ce5
WORKDIR /var/www/html