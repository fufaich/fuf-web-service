Собираем стек **Nginx + PHP + MySQL + phpMyAdmin** в Docker. Вот пошаговая инструкция:

---

### **1. Структура проекта**
```
my_project/
├── src/               # Исходный код PHP-приложения
│   └── index.php      # Пример PHP-файла
├── docker/
│   └── nginx/
│       └── nginx.conf # Конфиг Nginx
├── php/
│   └── Dockerfile     # Кастомизация PHP
└── docker-compose.yml
```

---

### **2. `docker-compose.yml`**
```yaml
version: '3.8'

services:
  nginx:
    image: nginx:latest
    ports:
      - "80:80"
    volumes:
      - ./src:/var/www/html
      - ./docker/nginx/nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php

  php:
    build: ./php  # Сборка из Dockerfile
    volumes:
      - ./src:/var/www/html
    environment:
      - DB_HOST=mysql
      - DB_NAME=app_db
      - DB_USER=app_user
      - DB_PASSWORD=secret

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: app_db
      MYSQL_USER: app_user
      MYSQL_PASSWORD: secret
    volumes:
      - mysql_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "8080:80"
    environment:
      PMA_HOST: mysql  # Имя сервиса MySQL
    depends_on:
      - mysql

volumes:
  mysql_data:
```

---

### **3. Dockerfile для PHP (`php/Dockerfile`)**
```dockerfile
FROM php:8.2-fpm

# Установка расширений для работы с MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mysqli mbstring gd exif
```

---

### **4. Конфиг Nginx (`docker/nginx/nginx.conf`)**
```nginx
server {
    listen 80;
    index index.php;
    server_name localhost;
    root /var/www/html;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_pass php:9000;  # Имя сервиса PHP из docker-compose.yml
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

### **5. Пример PHP-кода (`src/index.php`)**
```php
<?php
try {
    $db = new PDO(
        "mysql:host=mysql;dbname=app_db",
        "app_user",
        "secret"
    );
    echo "Connected to MySQL!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

---

### **6. Запуск**
```bash
docker-compose up -d --build
```

После запуска:
- Веб-приложение доступно по **http://localhost**
- phpMyAdmin — **http://localhost:8080**  
  Логин: `app_user`, Пароль: `secret` (либо root: `root_password`).

---

### **7. Основные команды**
- Остановить стек:  
  ```bash
  docker-compose down
  ```
- Просмотр логов MySQL:  
  ```bash
  docker-compose logs mysql
  ```
- Войти в контейнер PHP:  
  ```bash
  docker-compose exec php bash
  ```

---

### **8. Советы**
1. **Тома (Volumes)**:  
   Данные MySQL сохраняются в томе `mysql_data`, чтобы не потерять их при перезапуске.

2. **Безопасность**:  
   Не используйте простые пароли в продакшене. Для защиты добавьте:
   - `.env`-файл для переменных окружения.
   - SSL-сертификаты в Nginx.

3. **Отладка**:  
   Если PHP не подключается к MySQL, проверьте:
   - Запущен ли контейнер `mysql` (`docker ps`).
   - Правильность логина/пароля в коде PHP.

---

Готово! Теперь у вас есть полноценный стек для разработки на Linux, аналогичный OpenServer. 🐳