# Базовый образ
FROM php:8.2-apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    zip unzip libsqlite3-dev sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite

# Включение модуля rewrite для Apache
RUN a2enmod rewrite

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html

# Копирование файлов приложения
COPY . .

ENV DB_CONNECTION=sqlite
ENV APP_ENV=local
ENV APP_DEBUG=true
ENV API_KEY=secret


# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Настройка прав доступа
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache



# Настройка Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Порт
EXPOSE 80

# Команда запуска
CMD ["apache2-foreground"]