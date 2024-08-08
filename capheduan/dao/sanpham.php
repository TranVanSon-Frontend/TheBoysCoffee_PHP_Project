<?php
require_once 'pdo.php';

function add_sanpham($categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special, $view)
{
    $sql = "INSERT INTO sanpham (id_catalog, ma_sp, ten_sp, gia, giam_gia, hinh, hinh1, hinh2, hinh3, ngay_nhap, mo_ta, dac_biet, so_luot_xem) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    return pdo_execute($sql, $categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special, $view);
}

function updates_sanpham($id, $categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special)
{
    $sql = "UPDATE sanpham SET id=?, id_catalog=?, ma_sp=?, ten_sp=?, gia=?,  giam_gia=?,  hinh=?,  hinh1=?,  hinh2=?,  hinh3=?,  ngay_nhap=?,  mo_ta=?,  dac_biet=? WHERE id=" . $id;
    return pdo_execute($sql, $id, $categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special);
}

function updates_view_sanpham($id, $upview)
{
    $sql = "UPDATE sanpham SET id=?,so_luot_xem=? WHERE id=" . $id;
    return pdo_execute($sql, $id, $upview);
}

function delete_sanpham($id)
{
    $sql = 'DELETE FROM sanpham WHERE id= ?;';
    return pdo_execute($sql, $id);
}
// lượt mua
function get_soluong_sp()
{
    $sql = "SELECT COUNT(id) FROM sanpham WHERE 1";
    $count = pdo_query_value($sql);
    return $count;
}
function get_dssp_LuotMua($limit)
{
    $sql = "SELECT *, 
            (SELECT COUNT(*) FROM billchitiet WHERE billchitiet.id_product = sp.id) as luot_mua,
            sp.id, sp.id_catalog, dm.ten_loai 
            FROM sanpham sp 
            INNER JOIN danhmuc dm ON sp.id_catalog = dm.id  
            ORDER BY luot_mua DESC, sp.id DESC LIMIT " . $limit;
    return pdo_query($sql);
}

// function get_dssp_new($limit){
//     $sql = "SELECT  sp.id, ten_loai, hinh, sp.gia, sp.giam_gia, sp.so_luot_xem, sp.ten_sp
//             FROM sanpham sp 
//             INNER JOIN danhmuc dm ON sp.id_catalog = dm.id 
//             WHERE sp.ngay_nhap 
//             ORDER BY sp.ngay_nhap DESC 
//             LIMIT ".$limit;
//     return pdo_query($sql);
// }

// function get_dssp_best($limit){
//     $sql = "SELECT  *, sp.id as idsp, sp.ten_sp as namesp, dm.ten_loai as namedm 
//             FROM sanpham sp 
//             LEFT JOIN danhmuc dm ON sp.id_catalog = dm.id 
//             WHERE sp.dac_biet = 1 
//             ORDER BY sp.id DESC LIMIT ".$limit;
//     return pdo_query($sql);
// }

function get_dssp_new($limit)
{
    $sql = "SELECT sp.id, sp.ten_sp , sp.hinh, sp.gia, sp.giam_gia, sp.so_luot_xem, dm.ten_loai, sp.id_catalog,sp.dac_biet,sp.ngay_nhap
            FROM sanpham sp 
            INNER JOIN danhmuc dm ON sp.id_catalog = dm.id 
            WHERE sp.dac_biet = 2  -- Sửa điều kiện WHERE để lấy các sản phẩm có ngày nhập nhỏ hơn hoặc bằng ngày hiện tại
            ORDER BY sp.ngay_nhap DESC
            LIMIT " . $limit;
    return pdo_query($sql);
}
function get_dssp_best($limit)
{
    $sql = "SELECT sp.id, sp.ten_sp , sp.hinh, sp.gia, sp.giam_gia, sp.so_luot_xem, dm.ten_loai, sp.id_catalog,sp.dac_biet
            FROM sanpham sp 
            LEFT JOIN danhmuc dm ON sp.id_catalog = dm.id 
            WHERE sp.dac_biet = 1  -- Chỉ lấy các sản phẩm có đặc biệt = 1
            ORDER BY sp.id DESC 
            LIMIT " . $limit;
    return pdo_query($sql);
}


function get_loai_sp($limit, $loai_san_pham) {
    $sql = "SELECT sp.*
            FROM sanpham sp
            JOIN danhmuc lh ON sp.id_catalog = lh.id
            WHERE lh.loai_san_pham = '" . $loai_san_pham . "'
            ORDER BY sp.so_luot_xem DESC
            LIMIT " . $limit;
    return pdo_query($sql);
}


// function view_sp_caphe($limit, $loai_san_pham) {
    
//         $html_banner = '';
//         extract($sp);
//         $html_banner .= '
//        return $html_banner;
// }     
// }

function showspBanner($dssp) {
    $html_dssp_banner = '';

    if (is_array($dssp) && count($dssp) > 0) {
        foreach ($dssp as $sp) {
            $html_dssp_banner .= '<div class="pro-15">
                <img src="images/' . $sp['hinh'] . '" alt="' . $sp['hinh'] . '">
                <p class="text-15">' . $sp['ten_sp'] . '</p>
                <h2>' . number_format($sp['gia']) . ' VNĐ</h2>
                <div class="buttons">
                    <a href="index.php?pg=products&id=' . $sp['id'] . '" class="trailer">Mua Ngay</a>
                </div>
            </div>';
        }
    }
    return $html_dssp_banner;
}






function get_dssp_best_2($limit)
{
    $sql = "SELECT  * FROM sanpham WHERE dac_biet = 1 
            ORDER BY id DESC LIMIT " . $limit;
    return pdo_query($sql);
}

function get_dssp_view($limit)
{
    $sql = "SELECT  *, sp.id, dm.ten_loai 
            FROM sanpham sp 
            INNER JOIN danhmuc dm ON sp.id_catalog = dm.id 
            WHERE sp.so_luot_xem 
            ORDER BY sp.so_luot_xem DESC, sp.id DESC LIMIT " . $limit;
    return pdo_query($sql);
}


function get_dssp_all()
{
    $sql = "SELECT  *, sp.id, sp.id_catalog, dm.ten_loai FROM sanpham  INNER JOIN danhmuc dm ON sanpham.id_catalog = dm.id WHERE 1";
    return pdo_query($sql);
}

function get_dssp($keyword, $categoryId, $limit, $sethome, $order)
{
    $sql = "SELECT  *,sp.id, dm.ten_loai FROM sanpham sp INNER JOIN danhmuc dm ON sp.id_catalog = dm.id WHERE 1";

    if ($categoryId > 0) {
        if ($sethome == 0) {
            $sql .= " AND sp.dac_biet=" . $sethome;
        } else {
            $sql .= " AND sp.id_catalog=" . $categoryId;
        }
    }
    if ($keyword != "") {
        $sql .= " AND sp.ten_sp like '%" . $keyword . "%'";
    }
    if ($order == 'name_asc') {
        $sql .= " ORDER BY sp.ten_sp ASC";
    } elseif ($order == 'name_desc') {
        $sql .= " ORDER BY sp.ten_sp DESC";
    } elseif ($order == 'price_asc') {
        $sql .= " ORDER BY sp.gia ASC";
    } elseif ($order == 'price_desc') {
        $sql .= " ORDER BY sp.gia DESC";
    } else {
        // Mặc định sắp xếp theo ID giảm dần
        $sql .= " ORDER BY sp.id ASC";
    }
    $sql .= " LIMIT " . $limit;
    return pdo_query($sql);
}

function get_dssp_admin()
{
    $sql = "SELECT * FROM sanpham";
    return pdo_query($sql);
}

function get_sp_view($id)
{
    $sql = "SELECT so_luot_xem FROM sanpham WHERE id=?";
    return pdo_query_value($sql, $id);
}

function get_sp_id($id)
{
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query($sql, $id);
}
function get_sproduct($id)
{
    $sql = "SELECT *,sanpham.id,dm.ten_loai FROM sanpham INNER JOIN danhmuc dm ON sanpham.id_catalog = dm.id  WHERE sanpham.id=?";
    return pdo_query_one($sql, $id);
}

function get_dssp_lienquan($categoryId, $id, $limit)
{
    $sql = "SELECT * ,sanpham.id,dm.ten_loai FROM sanpham INNER JOIN danhmuc dm ON sanpham.id_catalog = dm.id  WHERE sanpham.id_catalog=? AND sanpham.id<>? ORDER BY sanpham.id DESC LIMIT " . $limit;
    return pdo_query($sql, $categoryId, $id);
}

function get_iddm($id)
{
    $sql = "SELECT id_catalog FROM sanpham WHERE id=?";
    return pdo_query_value($sql, $id);
}

function searchProducts($keyword, $categoryId, $limit)
{
    $sql = "SELECT * FROM sanpham WHERE (ten_sp LIKE :keyword OR mo_ta LIKE :keyword)";
    if ($categoryId != 0) {
        $sql .= " AND id_catalog = :categoryId";
    }

    $sql .= " LIMIT :limit";

    $params = [
        ':keyword' => '%' . $keyword . '%',
        ':limit' => $limit,
    ];

    if ($categoryId != 0) {
        $params[':categoryId'] = $categoryId;
    }

    return pdo_query($sql, $params);
}

function getPopularCategories()
{
    $sql = "SELECT id, ten_loai FROM danhmuc ORDER BY stt DESC LIMIT 5";
    return pdo_query($sql);
}
function showsp($dssp)
{
    $html_dssp = '';

    if (is_array($dssp) && count($dssp) > 0) {
        foreach ($dssp as $sp) {
            // $specialText = '';

            // // Kiểm tra và sử dụng khóa 'id_catalog' một cách an toàn


            // // Kiểm tra và sử dụng khóa 'dac_biet' một cách an toàn
            // if (isset($sp['dac_biet'])) {
            //     if ($sp['dac_biet'] == 2) {
            //         $specialText = 'NEW';
            //     } else if ($sp['dac_biet'] == 1) {
            //         $specialText = 'HOT';
            //     }
            // }
            $html_dssp .= '<div class="product-card">
        <a href="index.php?pg=products&id=' . $sp['id'] . '"><img src="images/' . $sp['hinh'] . '" alt="' . $sp['hinh'] . '">
        <div class="details">
            <div class="h3" style=" padding:0px 0px;"><h3>' . $sp['ten_sp'] . '</h3></div>
            
            <div class="text-bot" style="padding-top:10px;"><div class="price">' . number_format($sp['gia']) . ' VNĐ </div>
            <div class="original-price">' . number_format($sp['giam_gia']) . ' VNĐ </div>
            <div class="discount"><i class="fas fa-eye"></i>' . $sp['so_luot_xem'] . '</div>
           </div>
        </div>
        </a>
        <form class="add-to-cart-form">
        <input type="hidden" name="id" value="' . $sp['id'] . '">
        <input type="hidden" name="name" value="' . $sp['ten_sp'] . '">
        <input type="hidden" name="img" value="' . $sp['hinh'] . '">
        <input type="hidden" name="price" value="' . $sp['gia'] . '">
        <input type="hidden" name="soluong" value="1">
        <button type="button" class="add-button" onclick="addToCart(this.form)">+</button>
    </form>
          </div>';
        }
    }
    return $html_dssp;
}
function showchitietsp($sp)
{
    $html_chitietsp = '';
    extract($sp);
    $html_chitietsp .= '
            <div style="display:flex;margin:0px auto"><div class="product-image">
            <img src="images/' . $sp['hinh'] . '" alt="Product Image" id="main-image">
            <div class="thumbnail-images">
                <img src="images/' . $sp['hinh'] . '" alt="Thumbnail 1" onclick="changeImage(\'images/' . $sp['hinh'] . '\')">
                <img src="images/' . $sp['hinh'] . '" onclick="changeImage(\'images/' . $sp['hinh'] . '\')">
                <img src="images/' . $sp['hinh'] . '" alt="Thumbnail 3" onclick="changeImage(\'images/' . $sp['hinh'] . '\')">
            </div>
        </div>
        <div class="product-details">
            <h1>' . $sp['ten_sp'] . '</h1>
            <p class="price">' . number_format($sp['gia']) . ' VNĐ </p>
            <div class="promotion">
                <p>Khuyến mãi - Ưu đãi</p>
                <ul>
                    <li>Nhập mã <b>EGANY</b> thêm 5% đơn hàng</li>
                    <li>Giảm giá 10% khi mua từ 5 sản phẩm</li>
                    <li>Tặng phiếu mua hàng khi mua từ 500k</li>
                </ul>
            </div>
            
            <form method="POST" action="index.php?pg=cart" style="padding-top:15px;">
            <input type="hidden" name="pg" value="cart">
                                <input type="hidden" name="id" value="' . $id . '">
                                <input type="hidden" name="name" value="' . $ten_sp . '">
                                <input type="hidden" name="img" value="' . $hinh . '">
                                <input type="hidden" name="price" value="' . $gia . '">
            <div class="quantity">
                <label>Nhập số lượng:</label>
                <div class="quantity-controls">
                  
                    <input type="number" name="soluong" style="margin:0px; border-radius: 0px; padding:6px; width:40px;" id="quantity" value="1" min="1">
                    
                  
                </div>
            </div>
            <div class="buttons">               
                  <button class="normal" type="submit" name="cart">Mua ngay</button>
                  <button type="button" onclick="addToCart(this.form)">Thêm vào giỏ</button>
            </div>
            </form>
            <div class="call">
                Gọi đặt mua 1800.0000 (7:30 - 22:00)
            </div>
        </div>
        </div>
         <div class="text" style="margin:0px auto;width:1300px;color: #555;">
         <h2 style="color: #000;">Mô tả sản phẩm</h2>
         <div class="text-1"><h4>' . $sp['mo_ta'] . '</h4></div>
         </div>';
    return $html_chitietsp;
}
function show_sp_admin($dssp){
    $html_dssp_admin = '';
    $i = 0;
    foreach ($dssp as $item){
        $i++;
        $html_dssp_admin .= '<tr>
                                <td>'.$i.'</td>
                                <td><img src="../images/'.$item['hinh'].'" alt="" width="82px"></td>
                                <td>'.$item['ten_sp'].'</td>
                                <td>'.number_format($item['gia']).' VNĐ</td>
                                <td>'.$item['giam_gia'].' VNĐ</td>
                                <td>'.$item['ngay_nhap'].'</td>
                                <td>
                                    <a href="index.php?pg=products_updates&id_updates='.$item['id'].'" class="btn btn-warning"><i
                                            class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="index.php?pg=products&id_delete='.$item['id'].'" class="btn btn-danger"><i
                                            class="fa-solid fa-trash"></i> Xóa</a>
                                </td>
                            </tr>';
    }
    return $html_dssp_admin;
}
