Вот готовая конфигурация для стека **Nginx + PHP + PostgreSQL + pgAdmin** в Docker:

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
      - DB_HOST=postgres
      - DB_PORT=5432
      - DB_NAME=app_db
      - DB_USER=app_user
      - DB_PASSWORD=secret

  postgres:
    image: postgres:15
    environment:
      POSTGRES_DB: app_db
      POSTGRES_USER: app_user
      POSTGRES_PASSWORD: secret
    volumes:
      - postgres_data:/var/lib/postgresql/data

  pgadmin:
    image: dpage/pgadmin4:latest
    environment:
      PGADMIN_DEFAULT_EMAIL: admin@example.com
      PGADMIN_DEFAULT_PASSWORD: admin
    ports:
      - "5050:80"
    depends_on:
      - postgres

volumes:
  postgres_data:
```

---

### **3. Dockerfile для PHP (`php/Dockerfile`)**
```dockerfile
FROM php:8.2-fpm

# Установка расширений для работы с PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
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
        "pgsql:host=postgres;dbname=app_db",
        "app_user",
        "secret"
    );
    echo "Connected to PostgreSQL!";
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
- pgAdmin — **http://localhost:5050**  
  Логин: `admin@example.com`, Пароль: `admin`.

---

### **7. Как подключиться к PostgreSQL через pgAdmin**
1. Откройте pgAdmin в браузере.
2. Добавьте новый сервер:
   - **Name**: `Postgres Container`
   - **Host**: `postgres` (имя сервиса из docker-compose.yml)
   - **Port**: `5432`
   - **Username**: `app_user`
   - **Password**: `secret`.

---

### **8. Основные команды**
- Остановить стек:  
  ```bash
  docker-compose down
  ```
- Просмотр логов PostgreSQL:  
  ```bash
  docker-compose logs postgres
  ```
- Войти в контейнер PHP:  
  ```bash
  docker-compose exec php bash
  ```

---

### **9. Важные моменты**
1. **Тома (Volumes)**:  
   Данные PostgreSQL сохраняются в томе `postgres_data`, чтобы не потерять их при перезапуске.

2. **Расширения PHP**:  
   Убедитесь, что в Dockerfile установлены `pdo` и `pdo_pgsql`.

3. **Сеть**:  
   Контейнеры общаются через внутреннюю сеть Docker, поэтому в PHP-коде хост БД — `postgres` (имя сервиса).

---

Готово! Теперь у вас есть стек для работы с PostgreSQL на Linux. 🐘🚀