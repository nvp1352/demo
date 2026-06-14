# Sudes Sport PHP/MySQL Shop

Website thời trang thể thao phong cách tối giản: trang chủ, danh sách sản phẩm, lọc giá, chi tiết sản phẩm, giỏ hàng, thanh toán, admin xem sản phẩm/đơn hàng.

## Cài trên XAMPP/Laragon/Wamp
1. Copy thư mục `sudes_pili_style_shop` vào `htdocs` hoặc `www`.
2. Mở phpMyAdmin, import file `database.sql`.
3. Sửa `config/database.php` nếu tài khoản MySQL không phải `root` và mật khẩu rỗng.
4. Truy cập: `http://localhost/sudes_pili_style_shop`.
5. Admin: `http://localhost/sudes_pili_style_shop/admin` — user `admin`, pass `admin123`.

## Cài trên Ubuntu Apache
```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysql unzip -y
sudo unzip sudes_pili_style_shop.zip -d /var/www/html/
sudo mysql < /var/www/html/sudes_pili_style_shop/database.sql
sudo chown -R www-data:www-data /var/www/html/sudes_pili_style_shop
sudo systemctl restart apache2
```
Mở: `http://IP_SERVER/sudes_pili_style_shop`

## Database
Database: `sudes_shop`
Tables: `categories`, `products`, `orders`, `order_items`, `admins`.
