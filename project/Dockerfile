# Dockerfile untuk Frontend CodeIgniter 4

# Stage 1: Build stage
FROM php:8.2-apache AS builder

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libssl-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP intl extension (required by CodeIgniter 4.7+)
RUN docker-php-ext-install intl

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Runtime stage
FROM php:8.2-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libicu-dev \
    && docker-php-ext-enable opcache \
    && docker-php-ext-install intl \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy from builder
COPY --from=builder /var/www/html .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/writable

# Configure Apache to use public directory as DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Create .htaccess for rewrite rules if not exists
RUN if [ ! -f /var/www/html/public/.htaccess ]; then \
    echo '<IfModule mod_rewrite.c>' > /var/www/html/public/.htaccess && \
    echo '    RewriteEngine On' >> /var/www/html/public/.htaccess && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-f' >> /var/www/html/public/.htaccess && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-d' >> /var/www/html/public/.htaccess && \
    echo '    RewriteRule ^(.*)$ index.php/$1 [L]' >> /var/www/html/public/.htaccess && \
    echo '</IfModule>' >> /var/www/html/public/.htaccess; \
    fi

# Environment variables
ENV API_URL=http://localhost:5000
ENV CI_ENVIRONMENT=production

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
