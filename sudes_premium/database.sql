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
  slug VARCHAR(120) NOT NULL UNIQUE,
  parent_id INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT,
  name VARCHAR(180) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  regular_price DECIMAL(12,0) NOT NULL,
  sale_price DECIMAL(12,0) DEFAULT NULL,
  discount_percent INT DEFAULT 0,
  material VARCHAR(180),
  color VARCHAR(80),
  size VARCHAR(120),
  image VARCHAR(500) NOT NULL,
  hover_image VARCHAR(500),
  gallery TEXT,
  description TEXT,
  is_new TINYINT(1) DEFAULT 1,
  is_featured TINYINT(1) DEFAULT 0,
  stock INT DEFAULT 50,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(150) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  email VARCHAR(150),
  address TEXT NOT NULL,
  note TEXT,
  total DECIMAL(12,0) NOT NULL,
  status VARCHAR(40) DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(12,0) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO admins(username,password) VALUES ('admin', MD5('admin123'));

INSERT INTO categories(name,slug,parent_id) VALUES
('BST Mới','new-arrivals',NULL),('Thời trang nữ','women',NULL),('Thời trang nam','men',NULL),('Áo kiểu & sơ mi','tops',NULL),('Đầm & chân váy','dress-skirt',NULL),('Phụ kiện','accessories',NULL),('Sale','sale',NULL);

INSERT INTO products(category_id,name,slug,regular_price,sale_price,discount_percent,material,color,size,image,hover_image,gallery,description,is_new,is_featured,stock) VALUES
(1,'Sudes Linen Blazer Kem','sudes-linen-blazer-kem',1690000,1390000,18,'Linen cao cấp phối cotton','Kem','S,M,L','https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=900&q=85','Blazer dáng suông tối giản, phù hợp đi làm, đi chơi và phối cùng quần short hoặc quần tây.',1,1,30),
(2,'Đầm Midi Satin Noir','dam-midi-satin-noir',1890000,1590000,16,'Satin mềm ánh nhẹ','Đen','S,M,L','https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=900&q=85','Đầm midi sang trọng, đường cắt mềm, tôn dáng và dễ phối cùng phụ kiện ánh kim.',1,1,25),
(2,'Áo Sơ Mi Lụa Ivory','ao-so-mi-lua-ivory',990000,790000,20,'Lụa satin thoáng mát','Trắng ngà','S,M,L,XL','https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=900&q=85','Áo sơ mi basic cao cấp, form nhẹ, hợp phối layer theo phong cách thanh lịch.',1,0,40),
(3,'Áo Khoác Bomber Urban','ao-khoac-bomber-urban',1490000,1190000,20,'Polyester chống gió nhẹ','Xám khói','M,L,XL','https://images.unsplash.com/photo-1507680434567-5739c80be1ac?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1507680434567-5739c80be1ac?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=900&q=85','Bomber nam hiện đại, chất liệu nhẹ, dễ mặc hằng ngày.',1,1,35),
(4,'Crop Top Ribbed Beige','crop-top-ribbed-beige',590000,490000,17,'Cotton rib co giãn','Beige','S,M,L','https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=85','Crop top dệt gân, ôm nhẹ, hợp phối cùng chân váy hoặc quần jeans.',1,0,60),
(5,'Chân Váy Tweed Mini','chan-vay-tweed-mini',890000,690000,22,'Tweed dệt nổi','Trắng đen','S,M,L','https://images.unsplash.com/photo-1551803091-e20673f15770?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1542060748-10c28b62716f?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1551803091-e20673f15770?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1542060748-10c28b62716f?auto=format&fit=crop&w=900&q=85','Chân váy tweed trẻ trung, form A, tạo điểm nhấn nữ tính.',1,1,22),
(6,'Túi Mini Chain Bag','tui-mini-chain-bag',1290000,990000,23,'Da PU cao cấp','Đen','One size','https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=85','Túi mini dây xích, nhỏ gọn, phù hợp đi tiệc và dạo phố.',1,1,18),
(7,'Quần Tây Wide Leg','quan-tay-wide-leg',1190000,890000,25,'Twill mềm đứng form','Nâu','S,M,L,XL','https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1506629905607-d9c297d7e54c?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1506629905607-d9c297d7e54c?auto=format&fit=crop&w=900&q=85','Quần ống rộng thanh lịch, cạp cao, dễ phối outfit công sở.',1,0,38),
(1,'Set Knit Cardigan & Skirt','set-knit-cardigan-skirt',2190000,1790000,18,'Len cotton mềm','Ghi sáng','S,M,L','https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1502716119720-b23a93e5fe1b?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1502716119720-b23a93e5fe1b?auto=format&fit=crop&w=900&q=85','Set knit đồng bộ, nhẹ nhàng, hợp mùa thu đông.',1,1,20),
(3,'Áo Thun Premium Essential','ao-thun-premium-essential',490000,390000,20,'Cotton compact 2 chiều','Trắng','M,L,XL','https://images.unsplash.com/photo-1520975682031-a05a3e68f8c3?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1520975682031-a05a3e68f8c3?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=85','Áo thun nam basic cao cấp, cổ tròn, phù hợp mọi outfit.',1,0,80),
(2,'Áo Khoác Trench Coat Sand','ao-khoac-trench-coat-sand',2490000,1990000,20,'Kaki cotton chống nhăn','Sand','S,M,L','https://images.unsplash.com/photo-1520975954732-35dd22299614?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1520975954732-35dd22299614?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?auto=format&fit=crop&w=900&q=85','Trench coat dáng dài, tạo vẻ ngoài thanh lịch và hiện đại.',1,1,12),
(6,'Mắt Kính Cat Eye','mat-kinh-cat-eye',690000,590000,14,'Gọng acetate','Đen','One size','https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=85','https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=900&q=85,https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=85','Phụ kiện kính cat eye cá tính, hoàn thiện outfit thời trang.',1,0,45);
