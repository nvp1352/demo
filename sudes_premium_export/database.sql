CREATE DATABASE IF NOT EXISTS sudes_premium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sudes_premium;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS admins;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  slug VARCHAR(140) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT,
  name VARCHAR(180) NOT NULL,
  slug VARCHAR(200) NOT NULL UNIQUE,
  price INT NOT NULL,
  sale_price INT DEFAULT NULL,
  image VARCHAR(500) NOT NULL,
  hover_image VARCHAR(500) DEFAULT NULL,
  description TEXT,
  sizes VARCHAR(80) DEFAULT 'S,M,L,XL',
  color VARCHAR(80) DEFAULT 'Đen',
  is_new TINYINT(1) DEFAULT 1,
  is_sale TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(150) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  address VARCHAR(255) NOT NULL,
  note TEXT,
  total INT NOT NULL,
  status VARCHAR(50) DEFAULT 'Chờ xử lý',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price INT NOT NULL,
  size VARCHAR(20),
  FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admins(username,password) VALUES ('admin', '$2y$10$rXk0cPE4Y5a8gBaJk.U8IuyqUXjBwrH3IV5bBIDvMeHwnuCQ5hPe.');

INSERT INTO categories(name,slug) VALUES
('BST Mới','new-arrivals'),('Thời trang nữ','women'),('Thời trang nam','men'),('Phụ kiện','accessories'),('Sale','sale');

INSERT INTO products(category_id,name,slug,price,sale_price,image,hover_image,description,sizes,color,is_new,is_sale) VALUES
(1,'Sudes Linen Blazer','sudes-linen-blazer',1290000,NULL,'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=900&q=80','Áo blazer linen tối giản, form đứng nhẹ, phù hợp đi làm và dạo phố.','S,M,L','Beige',1,0),
(2,'Đầm Midi Ivory','dam-midi-ivory',1590000,1390000,'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=80','Đầm midi nữ tính với gam màu ivory sang trọng, chất vải mềm rũ.','S,M,L','Ivory',1,1),
(1,'Áo Sơ Mi Satin','ao-so-mi-satin',890000,NULL,'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=900&q=80','Sơ mi satin bóng nhẹ, dễ phối cùng quần âu, chân váy hoặc denim.','S,M,L,XL','Trắng',1,0),
(2,'Chân Váy Pleated Noir','chan-vay-pleated-noir',990000,790000,'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&w=900&q=80','Chân váy xếp ly màu đen, phong cách thanh lịch và hiện đại.','S,M,L','Đen',1,1),
(3,'Áo Khoác Minimal Men','ao-khoac-minimal-men',1490000,NULL,'https://images.unsplash.com/photo-1516257984-b1b4d707412e?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1520975682031-a6ff851e9c89?auto=format&fit=crop&w=900&q=80','Áo khoác nam tối giản, chất liệu dày vừa, phối đồ linh hoạt.','M,L,XL','Navy',1,0),
(3,'Quần Âu Relaxed','quan-au-relaxed',1090000,890000,'https://images.unsplash.com/photo-1492447166138-50c3889fccb1?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1506629905607-d9f297d9c5c5?auto=format&fit=crop&w=900&q=80','Quần âu nam dáng relaxed, phù hợp phong cách smart casual.','M,L,XL','Xám',1,1),
(4,'Túi Mini Croissant','tui-mini-croissant',1190000,NULL,'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=80','Túi mini phom cong, điểm nhấn thanh lịch cho outfit hằng ngày.','Free','Đen',1,0),
(4,'Kính Mắt Studio','kinh-mat-studio',690000,590000,'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80','Kính mắt thời trang form vuông, bảo vệ mắt và nâng tầm phong cách.','Free','Nâu',1,1),
(1,'Set Knit Luxury','set-knit-luxury',1890000,NULL,'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=900&q=80','Set knit mềm mại, sang trọng, phù hợp mùa thu đông.','S,M,L','Kem',1,0),
(2,'Áo Cropped Tailor','ao-cropped-tailor',790000,NULL,'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=900&q=80','Áo croptop tailoring, đường cắt hiện đại, tôn dáng.','S,M,L','Đen',1,0),
(3,'Sơ Mi Oversize Men','so-mi-oversize-men',850000,NULL,'https://images.unsplash.com/photo-1516826957135-700dedea698c?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=900&q=80','Sơ mi nam oversize, chất cotton thoáng, kiểu dáng trẻ trung.','M,L,XL','Trắng',1,0),
(1,'Đầm Đen Signature','dam-den-signature',1690000,1490000,'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&w=900&q=80','https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=80','Đầm đen basic cao cấp, dễ mặc trong nhiều dịp.','S,M,L','Đen',1,1);
