<?php
require_once 'pdo.php';
function getBestSellingProducts()
{
    // Truy vấn dữ liệu từ bảng billchitiet
    $sql = "SELECT bct.id_product, sp.ten_sp, SUM(bct.so_luong) AS total_sold
            FROM billchitiet bct
            INNER JOIN sanpham sp ON bct.id_product = sp.id
            GROUP BY bct.id_product
            ORDER BY total_sold DESC";

    return pdo_query($sql);
}
?>