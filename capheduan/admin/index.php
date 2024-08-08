<?php
session_start();
ob_start();

include "../dao/pdo.php";
include "../dao/danhmuc.php";
include "../dao/user.php";
include "../dao/bill.php";
include "../dao/sanpham.php";
include "../dao/thong-ke.php";
include "../dao/comment.php";
include "../dao/banners.php";
include "view/header.php";

$dsdm_categories = get_danhmuc();
$dssp = get_dssp_admin();
$ds_user = get_all_users(0);
$ds_user_new = get_all_users(1);
$ds_bill = get_all_bill(0);
$ds_bill_new = get_all_bill(1);
$get_banners = get_all_banners();
if (!isset($_GET['pg'])) {
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'categories_add':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $ten = $_POST['name'];
                $stt = $_POST['stt'];
                $sethome = $_POST['sethome'];
                add_danhmuc($ten, $stt, $sethome);
                header("location: index.php?pg=categories");
            }
            include "view/categories_add.php";
            break;
        case 'categories_updates':
            if (isset($_GET['id_updates'])) {
                $id = $_GET['id_updates'];
                $old_values = get_dm_id($id);
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $ten = $_POST['name'];
                $stt = $_POST['stt'];
                $sethome = $_POST['sethome'];
                updates_danhmuc($id, $ten, $stt, $sethome);
                header("location: index.php?pg=categories");
            }
            include "view/categories_updates.php";
            break;
        case 'categories':
            if (isset($_GET["id_delete"]) && ($_GET["id_delete"] > 0)) {
                $id = $_GET["id_delete"];
                if (check_products_exists($id)) {
                    echo "<script>
                    alert('Không thể xóa vì có sản phẩm trong danh mục này.');
                    
                </script>";
                } else{
                    delete_danhmuc($id);
                    header("location: index.php?pg=categories");
                }            
                
             
            }
            include "view/categories.php";
            break;
        case 'products_add':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $ten_sp = $_POST['name'];
                $img = $_POST['img'];
                $img1 = $_POST['img1'];
                $img2 = $_POST['img2'];
                $img3 = $_POST['img3'];
                $categories = $_POST['categories'];
                $date = $_POST['date'];
                $gia = $_POST['price'];
                $gia_giam = $_POST['price_sale'];
                $mota = htmlspecialchars($_POST['description']);
                $special = $_POST['special'];
                $view = $_POST['view'];
                $product_code = $_POST['product_code'];
                add_sanpham($categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special, $view);
                header("location: index.php?pg=products");
            }
            include "view/products_add.php";
            break;
        case 'products_updates':
            if (isset($_GET['id_updates'])) {
                $id = $_GET['id_updates'];
                $old_values = get_sp_id($id);
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $ten_sp = $_POST['name'];
                $img = $_POST['img'];
                $img1 = $_POST['img1'];
                $img2 = $_POST['img2'];
                $img3 = $_POST['img3'];
                $categories = $_POST['categories'];
                $date = $_POST['date'];
                $gia = $_POST['price'];
                $gia_giam = $_POST['price_sale'];
                $mota = $_POST['description'];
                $special = $_POST['special'];
                $view = $_POST['view'];
                $product_code = $_POST['product_code'];
                updates_sanpham($id, $categories, $product_code, $ten_sp, $gia, $gia_giam, $img, $img1, $img2, $img3, $date, $mota, $special,$view);
                header("location: index.php?pg=products");
            }
            include "view/products_updates.php";
            break;
        case 'products':
            if (isset($_GET["id_delete"]) && ($_GET["id_delete"] > 0)) {
                $id = $_GET["id_delete"];
                
                if (check_order_exists($id)) {
                    echo "<script>
                    alert('Không thể xóa vì đã có người đặt hàng.');
                    
                </script>";
                } else{
                    delete_sanpham($id);
                    header("location: index.php?pg=products");
                }
            }
            include "view/products.php";
            break;
        case 'user_changepassword':
            include "view/user_changepassword.php";
            break;
        case 'binhluan':
            include "view/binhluan.php";
            break;
        case 'user_edit':
            include "view/user_edit.php";
            break;
        case 'user':
            include "view/user.php";
        case 'thongke':
            include "view/thongke.php";
            break;
        case 'order':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_status'])) {
                $bill_id = $_POST['bill_id'];
                $new_status = $_POST['new_status'];
                if (in_array($new_status, [1, 2, 3, 4, 5])) {
                    update_bill_status($bill_id, $new_status);
                } else {
                    echo 'Trạng thái không hợp lệ';
                }
            }
            $ds_bill = get_all_bill(0);
            $html_ds_bill = show_bill_admin($ds_bill);
            include "view/order.php";
            break;
        case 'banners':
            $user_id = $_SESSION['id_user'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_banner'])) {
                $title = $_POST['title'];
                $image_url = $_POST['image_url'];
                $start_date = $_POST['start_date'];
                add_banner($title, $image_url, $start_date, $user_id);
            }

            // Xử lý cập nhật trạng thái kích hoạt
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['update_status'])) {
                    $banner_id = $_POST['banner_id'];
                    $is_active = $_POST['is_active'];
                    try {
                        update_banner_status($banner_id, $is_active);
                        header('Location:index.php?pg=banners');
                        exit;
                    } catch (Exception $e) {
                        echo "<p>Lỗi khi cập nhật trạng thái banner: " . $e->getMessage() . "</p>";
                    }
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_banner'])) {
                $banner_id = $_POST['banner_id'];
                try {
                    delete_banner_by_id($banner_id);
                    header('Location:index.php?pg=banners');
                } catch (Exception $e) {
                    echo "<p>Lỗi khi xóa banner: " . $e->getMessage() . "</p>";
                }
            }

            include "view/banners.php";
            break;
        case 'banner_edit':

            // Kiểm tra và lấy thông tin banner
            if (isset($_GET['banner_id'])) {
                $banner_id = intval($_GET['banner_id']); // Chuyển đổi thành số nguyên để bảo mật
                $sql = "SELECT * FROM banners WHERE id = ?";
                $banner = pdo_query_one($sql, $banner_id);

                if (!$banner) {
                    echo "Banner không tồn tại.";
                    exit;
                }
            } else {
                echo "ID banner không hợp lệ.";
                exit;
            }

            // Xử lý cập nhật banner khi biểu mẫu được gửi
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_banner'])) {
                $banner_id = intval($_POST['banner_id']); // Chuyển đổi thành số nguyên để bảo mật
                $title = $_POST['title'];
                $image_url = $_POST['image_url'];
                $start_date = $_POST['start_date'];

                $sql = "UPDATE banners SET title = ?, image_url = ?, start_date = ? WHERE id = ?";
                try {
                    pdo_execute($sql, $title, $image_url, $start_date, $banner_id);
                    header('Location:index.php?pg=banners');
                    exit;
                } catch (Exception $e) {
                    echo "<p>Lỗi khi cập nhật banner: " . $e->getMessage() . "</p>";
                }
            }
            include "view/banner_edit.php";

            break;

        default:
            include "view/home.php";
            break;
    }
}

include "view/footer.php";
