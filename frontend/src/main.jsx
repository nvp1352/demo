import React, { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";
import axios from "axios";
import "./style.css";

const API = "http://localhost:3000/api";

function App() {
  const [products, setProducts] = useState([]);
  const [cart, setCart] = useState([]);
  const [admin, setAdmin] = useState(null);
  const [orders, setOrders] = useState([]);

  useEffect(() => {
    loadProducts();
  }, []);

  async function loadProducts() {
    const res = await axios.get(`${API}/products`);
    setProducts(res.data);
  }

  function addToCart(product) {
    const exists = cart.find(item => item.id === product.id);
    if (exists) {
      setCart(cart.map(item => item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item));
    } else {
      setCart([...cart, { ...product, quantity: 1 }]);
    }
  }

  async function order(e) {
    e.preventDefault();
    const form = new FormData(e.target);

    await axios.post(`${API}/orders`, {
      customer_name: form.get("customer_name"),
      phone: form.get("phone"),
      address: form.get("address"),
      cart
    });

    alert("Đặt hàng thành công");
    setCart([]);
    e.target.reset();
  }

  async function login(e) {
    e.preventDefault();
    const form = new FormData(e.target);

    const res = await axios.post(`${API}/auth/login`, {
      email: form.get("email"),
      password: form.get("password")
    });

    localStorage.setItem("token", res.data.token);
    setAdmin(res.data.user);
    loadOrders();
  }

  async function loadOrders() {
    const token = localStorage.getItem("token");
    const res = await axios.get(`${API}/orders`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    setOrders(res.data);
  }

  const total = cart.reduce((sum, item) => sum + Number(item.price) * item.quantity, 0);

  return (
    <>
      <header className="header">
        <div className="logo">FASHION</div>
        <nav>
          <a href="#home">Trang chủ</a>
          <a href="#products">Sản phẩm</a>
          <a href="#cart">Giỏ hàng</a>
          <a href="#admin">Admin</a>
        </nav>
      </header>

      <section id="home" className="hero">
        <div>
          <p className="tag">Bộ sưu tập 2026</p>
          <h1>Thời trang hiện đại cho mọi ngày</h1>
          <p>Áo thun, sơ mi, váy, quần jean và phụ kiện với phong cách trẻ trung.</p>
          <a href="#products" className="btn">Mua ngay</a>
        </div>
      </section>

      <section className="service">
        <div>🚚 Giao hàng nhanh</div>
        <div>💳 Thanh toán khi nhận hàng</div>
        <div>🔄 Đổi trả 7 ngày</div>
      </section>

      <section id="products" className="section">
        <h2>Sản phẩm nổi bật</h2>
        <div className="grid">
          {products.map(product => (
            <div className="card" key={product.id}>
              <img src={product.image} alt={product.name} />
              <h3>{product.name}</h3>
              <p>{product.description}</p>
              <strong>{Number(product.price).toLocaleString()} VNĐ</strong>
              <button onClick={() => addToCart(product)}>Thêm vào giỏ</button>
            </div>
          ))}
        </div>
      </section>

      <section id="cart" className="section cart">
        <h2>Giỏ hàng</h2>
        {cart.length === 0 ? <p>Giỏ hàng trống</p> : cart.map(item => (
          <div className="cart-row" key={item.id}>
            <span>{item.name}</span>
            <span>SL: {item.quantity}</span>
            <span>{(Number(item.price) * item.quantity).toLocaleString()} VNĐ</span>
          </div>
        ))}
        <h3>Tổng tiền: {total.toLocaleString()} VNĐ</h3>

        <form onSubmit={order} className="form">
          <input name="customer_name" placeholder="Họ tên" required />
          <input name="phone" placeholder="Số điện thoại" required />
          <input name="address" placeholder="Địa chỉ" required />
          <button>Đặt hàng</button>
        </form>
      </section>

      <section id="admin" className="section admin">
        <h2>Admin</h2>
        {!admin ? (
          <form onSubmit={login} className="form">
            <input name="email" defaultValue="admin@gmail.com" placeholder="Email" />
            <input name="password" defaultValue="123456" type="password" placeholder="Mật khẩu" />
            <button>Đăng nhập admin</button>
          </form>
        ) : (
          <>
            <p>Xin chào: {admin.name}</p>
            <button onClick={loadOrders}>Tải đơn hàng</button>
            {orders.map(order => (
              <div className="order" key={order.id}>
                <b>Đơn #{order.id}</b> - {order.customer_name} - {Number(order.total).toLocaleString()} VNĐ - {order.status}
              </div>
            ))}
          </>
        )}
      </section>

      <footer>© 2026 Fashion Shop</footer>
    </>
  );
}

createRoot(document.getElementById("root")).render(<App />);
