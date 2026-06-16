# Sudes Real Fashion Shop

Website thời trang PHP/MySQL chạy Apache, dùng ảnh thời trang thật qua link Unsplash online.

## Database duy nhất

`sudes_shop`

## Admin

`/admin/login.php`

Tài khoản:

`admin / admin123`

## Cấu hình DB

File:

`config/database.php`

Mặc định:

```php
$host = '192.168.1.18';
$dbname = 'sudes_shop';
$username = 'fashion';
$password = '123456';
```

Nếu MySQL nằm cùng máy Apache thì đổi host thành:

```php
$host = 'localhost';
```

## Import database

```bash
mysql -u fashion -p < database.sql
```

Nếu user `fashion` chưa có quyền:

```sql
CREATE USER IF NOT EXISTS 'fashion'@'%' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON sudes_shop.* TO 'fashion'@'%';
FLUSH PRIVILEGES;
```

## Deploy lên Apache

```bash
sudo apt update
sudo apt install apache2 php php-mysql mysql-client unzip -y
sudo rm -rf /var/www/html/*
sudo unzip sudes_real_fashion_shop.zip -d /var/www/html/
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html
sudo systemctl restart apache2
```

Mở:

```text
http://IP_WEB/
```

Lưu ý: Ảnh dùng link online nên server cần có Internet để hiện ảnh.
