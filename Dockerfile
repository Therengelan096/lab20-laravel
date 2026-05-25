FROM php:8.3-apache

# Instalar extensiones necesarias de PHP para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilitar el módulo de reescritura de Apache para las rutas de Laravel
RUN a2enmod rewrite

# Cambiar la raíz de Apache para que apunte a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Instalar dependencias de producción de Composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permisos correctos para el servidor web
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Comando para optimizar y arrancar Apache
CMD php artisan optimize && apache2-foreground