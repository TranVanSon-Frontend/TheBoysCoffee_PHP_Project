<?php
session_start();
ob_start();
include_once "dao/pdo.php";
include_once "dao/sanpham.php";
include_once "dao/danhmuc.php";
include_once "dao/user.php";
include_once "dao/giohang.php";
include_once "dao/check.php";
include_once "dao/bill.php";
include_once "dao/banners.php";
include_once "dao/comment.php";
include_once "dao/send-email.php";
require "Mailer/src/PHPMailer.php";
require "Mailer/src/SMTP.php";
require "Mailer/src/Exception.php";
include_once "view/header.php";

$is_user_logged_in = is_user_logged_in();
$dssp_new = get_dssp_new(5);
$dssp_best = get_dssp_best(5);
$dssp_view = get_dssp_view(5);
$html_dssp_current_category = showsp(8);
$banner_caphe = get_loai_sp(3, 'cà phê');
$banner_may_caphe = get_loai_sp(3, 'Máy pha cà phê');
$ds_banners = get_active_banners();
if (!isset($_GET['pg'])) {
    include_once "view/home.php";
} else {  
    switch ($_GET['pg']) {

        case 'shop':
            $tieudetrang = "Danh sách sản phẩm";
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $id = $_GET['iddm'];
                $tieudetrang = "Sản phẩm " . get_name_dm($id);
            } else {
                $id = 0;
            }
            $dsdm = danhmuc_all();
            $kyw = "";
            $titlepage = "";
            $sethome = "";
            $order = "";
            if (!isset($_GET['iddm'])) {
                $iddm = 0;
            } else {
                $iddm = $_GET['iddm'];
                $titlepage = get_name_dm($iddm);
                $sethome = get_sethome_dm($iddm);
            }

            if (isset($_POST["timkiem"]) && ($_POST["timkiem"])) {
                $kyw = $_POST["kyw"];
                $titlepage = "Kết quả tìm kiếm với từ khóa: <span>" . $kyw . "</span>";
            }
            if (isset($_GET["order"]) && !empty($_GET["order"])) {
                $order = $_GET["order"];
            }

            $dssp = get_dssp($kyw, $iddm, 25, $sethome, $order);

            include_once "view/shop.php";
            break;
        case 'products':
            $dsdm = danhmuc_all();
            if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
                $id = $_GET["id"];
                $view = get_sp_view($id);
                $upview = (int)$view + 1;
                updates_view_sanpham($id, $upview);
                $spchitiet = get_sproduct($id);
                $iddm = get_iddm($id);
                $dssp_lienquan = get_dssp_lienquan($iddm, $id, 4);
            }
            if (is_user_logged_in()) {
                $id_user = $_SESSION['id_user'];
            }
            $ds_comment = get_all_comment_id_sampham($id);

            if (isset($_POST['send']) && $_POST['comment'] != '') {
                if (!is_user_logged_in()) {
                    header('location: index.php?pg=dangnhap');
                } else {
                    $id_user = $_SESSION['id_user'];
                    $comment = $_POST['comment'];
                    $ngay_bl = date('H:i:s d/m/Y');
                    comment($id, $id_user, $comment, $ngay_bl);
                    header("Location: index.php?pg=products&id=$id");
                }
            }
            include_once "view/products.php";
            break;
        case 'dangki':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $hoten = $_POST['hoten'];
                $email = $_POST['email'];
                $dienthoai = $_POST['dienthoai'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $register_result = register_user($hoten, $email, $dienthoai, $username, $password);
                if ($register_result === true) {
                    echo '<p style="color: green;">Đăng ký thành công! Đăng nhập <a href="index.php?pg=dangnhap">tại đây</a>.</p>';
                } else {
                    echo '<p style="color: red;">Đăng ký thất bại: ' . $register_result . '</p>';
                }
            }
            include_once "view/dangki.php";
            break;
        case 'dangnhap':
            if ($is_user_logged_in) {
                header("Location: index.php");
                exit();
            }
            $checkMK = 0;
            $saimatkhau = '';
            $saitaikhoan = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $user = get_user_by_username($username);
                    if ($user) {
                        $id_user = $user['id'];
                        $_SESSION['name'] = $username;
                        $_SESSION['id_user'] = $id_user;
                        $login_result = login_user($username, $password);
                        if ($login_result) {
                            $_SESSION['user_id'] = $login_result;
                            if (isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1)) {
                                echo '<center><p style="color: green;">Đăng nhập thành công!</p></center>';
                                header("Location: admin/index.php");
                            } else {
                                echo '<center><p style="color: green;">Đăng nhập thành công!</p></center>';
                                header("Location: index.php");
                            }
                            exit();
                        } else {
                            $checkMK = 1;
                            $saimatkhau = '<p style="color: red;">Đăng nhập thất bại: sai mật khẩu</p>';
                        }
                    } else {
                        $checkMK = 2;
                        $saitaikhoan = '<p style="color: red;">Tên đăng nhập không tồn tại!</p>';
                    }
                } else {
                    echo '<center><p style="color: red;">Thiếu thông tin đăng nhập!</p></center>';
                }
            }
            include_once "view/dangnhap.php";
            break;
        case 'dangxuat':
            if ($is_user_logged_in) {
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            }
            break;
        case 'profile-user':
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $hoten = $_POST['hoten'];
                $sdt = $_POST['number-phone'];
                $email = $_POST['email'];
                $diachi = $_POST['address'];
                $oldpass = $_POST['oldpass'];
                $newpass = $_POST['newpass'];
                $user = get_user_by_id($id);
                if (password_verify($oldpass, $user['password'])) {
                    $newpass_hash = password_hash($newpass, PASSWORD_BCRYPT);
                    update_password($id, $newpass_hash);
                }


                header("location: index.php?pg=profile-user&act=user_updates");
            }
            include_once "view/profile-user.php";
            break;
        case 'cart':
            if (isset($_POST['cart'])) {
                $product_id = $_POST['id'];
                $product_name = $_POST['name'];
                $product_img = $_POST['img'];
                $product_price = $_POST['price'];
                $product_quantity = $_POST['soluong'];
                $thanhtien = $product_price * $product_quantity;

                if (!$is_user_logged_in) {
                    echo '<script>alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");</script>';
                    echo '<script>window.location.href = "index.php?pg=dangnhap";</script>';
                    exit;
                } else {
                    $id_user = $_SESSION['id_user'];
                }

                $cart = get_cart_product($product_id, $id_user);
                $id_cart = $cart['id_product'];
                $user_cart = $cart['id_user'];

                if ($id_cart == $product_id && $user_cart == $id_user) {
                    $up_quantity = $cart['soluong'] + $_POST['soluong'];
                    $up_thanhtien = $up_quantity * $product_price;
                    updates_cart($product_id, $up_quantity, $up_thanhtien, $id_user);
                } else {
                    addcart($product_id, $id_user, $product_name, $product_img, $product_price, $product_quantity, $thanhtien);
                }
                header('Location: index.php?pg=cart');
            }
            $dsdm = danhmuc_all();

            include "view/cart.php";
            break;
        case 'checkout':
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['pg']) && $_GET['pg'] == 'dhthanhcong') {
                $email = $_POST['nguoinhan_email'];
                $name = $_POST['nguoinhan_ten'];
                $phone = $_POST['nguoinhan_sdt'];
                $address = $_POST['nguoinhan_diachi'];
                $notes = $_POST['order_notes'];
                $deliveryTime = $_POST['delivery_time'];
                $paymentMethod = $_POST['pt_thanhtoan'];
                $deliveryDate = $_POST['delivery_date'];
                $orderDate = $_POST['ngay_dat_hang'];
                $totalAmount = $_POST['tongtien'];
                $shippingFee = $_POST['ship'];
            
                // Lưu đơn hàng vào cơ sở dữ liệu
                
            
                // Gửi email xác nhận
                sentmail($email, $name, $phone, $address, $notes, $deliveryTime, $paymentMethod, $deliveryDate, $orderDate, $totalAmount, $shippingFee);
            
                // Chuyển hướng tới trang thành công
                header('Location: index.php?pg=dhthanhcong');
                exit();
            }
            
            
            include "view/checkout.php";
            break;
        case 'contact';

        include_once "view/contact.php";
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
        case 'cancel_order':
            if (isset($_GET['bill_id'])) {
                $billId = $_GET['bill_id'];
                $success = cancel_order($billId);

                if ($success) {
                    header("Location: index.php?pg=profile-user&act=order");
                    exit();
                } else {
                    // Đảm bảo không có đầu ra trước khi gọi header
                    header("Location: index.php?pg=profile-user&act=order");
                    exit();
                }
            } else {
                echo 'invalid_request';
            }
            break;

            case 'dhthanhcong':
                if (isset($_POST['thanhtoan'])) {
                    $ten = $_POST['nguoinhan_ten'];
                    $diachi = $_POST['nguoinhan_diachi'];
                    $sdt = $_POST['nguoinhan_sdt'];
                    $email = $_POST['nguoinhan_email'];
                    $pt_thanhtoan = $_POST['pt_thanhtoan'];
                    $tongtien = $_POST['tongtien'];
                    $deliveryTime = $_POST['delivery_time'];
                    $ship = $_POST['ship'];
                    $note = $_POST['order_notes'];
                    $delivery_date = $_POST['delivery_date'];
                    $ngay_dat_hang = $_POST['ngay_dat_hang'];
                    $notes = $deliveryTime . ' ' . $note;
                    $ngay_nhan_hang = $delivery_date;
                    $id_user = $_SESSION['id_user'];
                    srand(time());
                    $madonhang = 'BY-' . rand();
            
                    add_bill($id_user, $madonhang, $ten, $diachi, $sdt, $email, $pt_thanhtoan, $ship, $tongtien, $ngay_dat_hang, $ngay_nhan_hang, $notes);
            
                    
                    $subject = "Xác nhận đơn hàng";
                    $message = "
    <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #4CAF50; text-align: center;'>Xác nhận đơn hàng</h2>
        <div style='border: 1px solid #e0e0e0; border-radius: 5px; padding: 20px; background-color: #f9f9f9;'>
            <h3 style='color: #333;'>Thông tin đơn hàng của bạn:</h3>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Họ và tên:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$ten</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Họ và tên:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$madonhang</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Số điện thoại:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$sdt</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Địa chỉ:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$diachi</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Phương thức thanh toán:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$pt_thanhtoan</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Thời gian nhận hàng:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$deliveryTime</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Ngày nhận hàng:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$delivery_date</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Ngày đặt hàng:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$ngay_dat_hang</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Tổng tiền:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$tongtien VNĐ</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd; background-color: #f2f2f2;'><strong>Phí vận chuyển:</strong></td>
                    <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$ship VNĐ</td>
                </tr>
                <tr>
                    <td style='padding: 10px; background-color: #f2f2f2;'><strong>Ghi chú:</strong></td>
                    <td style='padding: 10px;'>$notes</td>
                </tr>
            </table>
        </div>
        <p style='text-align: center; color: #777; font-size: 12px; margin-top: 20px;'>Cảm ơn bạn đã mua hàng!</p>
    </div>
";            
                    if (Sentmail($email, $subject, $ten, $message)) {
                        $_SESSION['success_message'] = "Đơn hàng đã được đặt thành công và email xác nhận đã được gửi.";
                    } else {
                        $_SESSION['error_message'] = "Đơn hàng đã được đặt thành công nhưng gửi email thất bại.";
                    }
            
                    $id_bill = get_id_bill();
                    $id = $id_bill['id'];
            
                    if ($id != '') {
                        add_bill_chitiet($id, $id_user);
                        delete_cart_user($id_user);
                        header('location: index.php?pg=dhthanhcong');
                        exit();
                    }
                }
                include "view/dhthanhcong.php";
                break;            
        case 'about-us':

            include_once "view/about-us.php";
            break;
        default:
            include "view/home.php";
            break;
    }
}
include_once "view/footer.php";
