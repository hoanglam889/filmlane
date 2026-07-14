# Stage 1: Build frontend assets
FROM node:20 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP Application
FROM php:8.2-apache

# Cài đặt các system dependencies và PHP extensions cần thiết
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Xoá cache apt để giảm dung lượng image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài đặt PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_sqlite

# Bật Apache mod_rewrite cho Laravel
RUN a2enmod rewrite

# Đổi Document Root của Apache trỏ vào thư mục public của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ mã nguồn vào container
COPY . .

# Copy file build frontend (Vite/Tailwind) từ stage 1 sang
COPY --from=frontend /app/public/build /var/www/html/public/build

# Cài đặt PHP dependencies (bỏ qua các gói dev)
RUN composer install --optimize-autoloader --no-dev

# Thiết lập quyền cho các thư mục quan trọng
RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database

EXPOSE 80
