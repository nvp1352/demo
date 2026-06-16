# SUDES Premium Fashion Shop

Website PHP + MySQL chạy Apache, giao diện shop thời trang premium tương tự phong cách PILI/Zara/Maje.

## Tài khoản admin
- URL: `/admin/login.php`
- User: `admin`
- Pass: `admin123`

## Cài trên Ubuntu Apache
```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysql unzip -y
sudo unzip sudes_premium_fashion_shop.zip -d /var/www/html/
sudo mysql < /var/www/html/sudes_premium_export/database.sql
sudo systemctl restart apache2
```

Mở:
```text
http://IP_SERVER/sudes_premium_export
```

## Cấu hình database
File: `config/database.php`

Mặc định:
```php
$host = 'localhost';
$dbname = 'sudes_premium';
$username = 'root';
$password = '';
```

Nếu DB nằm ở server khác, sửa `$host` thành IP database server, ví dụ:
```php
$host = '192.168.1.18';
$username = 'sudes';
$password = '123456';
```

## Lưu ý ảnh
Ảnh sản phẩm dùng link Unsplash online HD. Server cần Internet để hiện ảnh.
