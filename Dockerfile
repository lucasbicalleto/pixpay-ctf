# Use a imagem oficial do PHP com Apache como base
FROM php:apache

# Instale a extensão MySQLi
RUN docker-php-ext-install mysqli

# Copie os arquivos do seu site para o diretório do Apache
COPY pixpay-ctf /var/www/html

# Senha do MySQL
ENV MYSQL_ROOT_PASSWORD=RS827vCaPo21xW3Zvla09SAez

# Exponha a porta 80
EXPOSE 80
