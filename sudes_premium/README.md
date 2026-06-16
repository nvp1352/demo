# SUDES Premium Fashion Shop

Website thời trang PHP + MySQL + Apache, giao diện cao cấp, dùng ảnh thật HD từ Unsplash qua link online.

## Cài trên Ubuntu Apache

```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysql unzip -y
sudo unzip sudes_premium_fashion_shop.zip -d /var/www/html/
sudo mysql < /var/www/html/sudes_premium/database.sql
sudo systemctl restart apache2
```

Mở web:

```text
http://IP_SERVER/sudes_premium
```

Admin:

```text
http://IP_SERVER/sudes_premium/admin/login.php
user: admin
pass: admin123
```

## Cấu hình database

File cấu hình nằm ở:

```text
config/database.php
```

Nếu MySQL không dùng root rỗng mật khẩu, sửa lại:

```php
$host = 'localhost';
$dbname = 'sudes_premium';
$username = 'root';
$password = '';
```

## Lưu ý ảnh

Ảnh sản phẩm đang dùng link ảnh thật từ Unsplash. Server cần có Internet để tải ảnh khi mở web. Nếu muốn dùng offline, tải ảnh về thư mục `assets/images` rồi đổi link trong bảng `products`.
