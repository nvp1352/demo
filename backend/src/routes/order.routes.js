const express = require("express");
const pool = require("../db");
const { auth, admin } = require("../middleware/auth");

const router = express.Router();

router.post("/", async (req, res) => {
  const { customer_name, phone, address, cart } = req.body;

  if (!cart || cart.length === 0) {
    return res.status(400).json({ message: "Giỏ hàng trống" });
  }

  const total = cart.reduce((sum, item) => sum + Number(item.price) * Number(item.quantity), 0);

  const conn = await pool.getConnection();
  try {
    await conn.beginTransaction();

    const [orderResult] = await conn.query(
      "INSERT INTO orders(customer_name, phone, address, total) VALUES (?, ?, ?, ?)",
      [customer_name, phone, address, total]
    );

    const orderId = orderResult.insertId;

    for (const item of cart) {
      await conn.query(
        "INSERT INTO order_details(order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)",
        [orderId, item.id, item.quantity, item.price]
      );
    }

    await conn.commit();
    res.json({ message: "Đặt hàng thành công", order_id: orderId });
  } catch (error) {
    await conn.rollback();
    res.status(500).json({ message: "Lỗi đặt hàng", error: error.message });
  } finally {
    conn.release();
  }
});

router.get("/", auth, admin, async (req, res) => {
  const [rows] = await pool.query("SELECT * FROM orders ORDER BY id DESC");
  res.json(rows);
});

router.put("/:id/status", auth, admin, async (req, res) => {
  await pool.query("UPDATE orders SET status=? WHERE id=?", [req.body.status, req.params.id]);
  res.json({ message: "Cập nhật trạng thái thành công" });
});

module.exports = router;
