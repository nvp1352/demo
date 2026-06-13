const express = require("express");
const pool = require("../db");
const { auth, admin } = require("../middleware/auth");

const router = express.Router();

router.get("/", async (req, res) => {
  const [rows] = await pool.query(`
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.id DESC
  `);
  res.json(rows);
});

router.get("/:id", async (req, res) => {
  const [rows] = await pool.query("SELECT * FROM products WHERE id = ?", [req.params.id]);
  if (rows.length === 0) return res.status(404).json({ message: "Không tìm thấy sản phẩm" });
  res.json(rows[0]);
});

router.post("/", auth, admin, async (req, res) => {
  const { name, price, image, description, stock, category_id } = req.body;
  const [result] = await pool.query(
    "INSERT INTO products(name, price, image, description, stock, category_id) VALUES (?, ?, ?, ?, ?, ?)",
    [name, price, image, description, stock, category_id]
  );
  res.json({ message: "Thêm sản phẩm thành công", id: result.insertId });
});

router.put("/:id", auth, admin, async (req, res) => {
  const { name, price, image, description, stock, category_id } = req.body;
  await pool.query(
    "UPDATE products SET name=?, price=?, image=?, description=?, stock=?, category_id=? WHERE id=?",
    [name, price, image, description, stock, category_id, req.params.id]
  );
  res.json({ message: "Cập nhật sản phẩm thành công" });
});

router.delete("/:id", auth, admin, async (req, res) => {
  await pool.query("DELETE FROM products WHERE id=?", [req.params.id]);
  res.json({ message: "Xóa sản phẩm thành công" });
});

module.exports = router;
