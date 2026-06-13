# Fashion Shop Full

Website bán quần áo thời trang gồm:

- Frontend React + Vite
- Backend Node.js + Express
- Database MySQL
- Đăng nhập admin
- Quản lý sản phẩm
- Trang chủ sản phẩm
- Giỏ hàng
- Đặt hàng
- Trang quản lý đơn hàng

## Cách chạy database

Mở MySQL và chạy file:

```bash
database/fashion_shop.sql
```

## Chạy backend

```bash
cd backend
npm install
npm run dev
```

Backend chạy tại:

```txt
http://localhost:3000
```

## Chạy frontend

```bash
cd frontend
npm install
npm run dev
```

Frontend chạy tại:

```txt
http://localhost:5173
```

## Tài khoản admin mẫu

```txt
Email: admin@gmail.com
Password: 123456
```

## Cấu hình MySQL

Sửa file:

```txt
backend/.env
```

```env
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=fashion_shop
JWT_SECRET=fashion_secret_2026
PORT=3000
```
