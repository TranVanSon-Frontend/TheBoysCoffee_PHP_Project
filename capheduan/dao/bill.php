<?php
require_once 'pdo.php';

function get_all_bill($new) {
    $sql = "SELECT * FROM bill WHERE 1";
    if ($new == 1) {
        $sql .= " ORDER BY id DESC LIMIT 7";
    }
    return pdo_query($sql);
}

// function get_bill_user($id_user) {
//     $sql = "SELECT * FROM bill WHERE id_user=$id_user";
//     return pdo_query($sql);
// }
function get_bill_user($id_user) {
    $sql = "SELECT * FROM bill WHERE id_user = ? AND trangthai <> 4";
    return pdo_query($sql, $id_user);
}
function get_billchitiet_user($id_user, $id_bill) {
    $sql = "SELECT *, bill.id, sp.hinh FROM bill 
            INNER JOIN billchitiet bct ON bill.id = bct.id_bill 
            INNER JOIN sanpham sp ON bct.id_product = sp.id 
            WHERE bct.id_user=$id_user AND bct.id_bill=$id_bill";
    return pdo_query($sql);
}

function get_soluong_bill() {
    $sql = "SELECT COUNT(id) FROM bill WHERE 1";
    $count = pdo_query_value($sql);
    return $count;
}

function get_tongtien_bill() {
    $sql = "SELECT SUM(tong_thanhtoan) AS tongtien_bill FROM bill WHERE trangthai = 3";
    return pdo_query_one($sql);
}

function show_billchitiet_user($dsbill) {
    $html_dsbill = '';
    $tongtien = 0;
    $ma_donhang_prev = '';
    $ngay_dat_hang_prev = '';

    foreach ($dsbill as $bill) {
        if ($ma_donhang_prev != $bill['ma_donhang']) {
            if ($ma_donhang_prev != '') {
                $html_dsbill .= '<tr>
                                    <td colspan="6"><b>Mã Đơn Hàng : ' . $ma_donhang_prev . '</b></td>
                                    <td colspan="2">' . renderCancelButton($dsbill[0]['trangthai'], $dsbill[0]['id']) . '</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="color:White;background-color:black;">Ngày: ' . $ngay_dat_hang_prev . ' </td>
                                    <td colspan="4" style="color:White;background-color:black;">TỔNG : ' . number_format($tongtien) . ' VNĐ</td>
                                </tr>';
            }

            $ma_donhang_prev = $bill['ma_donhang'];
            $ngay_dat_hang_prev = $bill['ngay_dat_hang'];
            $tongtien = 0;
        }

        $html_dsbill .= '<tr>
                            <td>' . $bill['ten_sp'] . '</td>
                            <td><img src="images/' . $bill['hinh'] . '" alt="" width="82px"></td>
                            <td>' . number_format($bill['gia']) . '</td>
                            <td >' . $bill['so_luong'] . '</td>
                            <td >' . number_format($bill['thanh_tien']) . ' VNĐ</td>
                            <td colspan="2">' . renderCancelButton($dsbill[0]['trangthai'], $dsbill[0]['id']) . '</td>
                        </tr>';

        $tongtien += $bill['thanh_tien'];
    }

    if ($ma_donhang_prev != '') {
        $html_dsbill .= '<tr>
                            <td colspan="2"><b>Mã Đơn Hàng : ' . $ma_donhang_prev . '</b></td>
                            <td colspan="3" style="color:red; font-size:20px;">Thành Tiền: ' . number_format($tongtien) . ' VNĐ</td>
                        </tr>
                        <tr> 
                            
                        </tr>

                        <tr>
                            <td colspan="1">Thông Tin Người Đặt Hàng :</td>
                            <td colspan="1"><h5>Họ Tên | ' . $dsbill[0]['nguoinhan_ten'] . '</h5></td>
                            <td colspan="2"><h5>Địa Chỉ | ' . $dsbill[0]['nguoinhan_diachi'] . '</h5></td>
                            <td colspan="1"><h5>Số Điện Thoại | ' . $dsbill[0]['nguoinhan_sdt'] . '</h5></td>
                        </tr>';
    }

    return $html_dsbill;
}

function renderCancelButton($status, $bill_id) {
    if ($status == 0) {
        return '<a href="index.php?pg=cancel_order&bill_id=' . $bill_id . '" onclick="return confirm(\'Bạn chắc chắn muốn hủy đơn hàng?\');" style="width:30px;">X</a>';
    } else {
        return '<button style="width:30px;" disabled>X</button>';
    }
}


function cancel_order($bill_id) {
    $sql = "UPDATE bill SET trangthai = 4 WHERE id = ?";
    return pdo_execute($sql, $bill_id);
}

function show_bill_user($dsbill) {
    $html_dsbill = '';
    $tong_thanhtoan_temp = array();

    foreach ($dsbill as $bill) {
        $ma_donhang = $bill['ma_donhang'];
        $ngay_dat_hang = $bill['ngay_dat_hang'];
        $status_text = getStatusText($bill['trangthai']);

        $html_dsbill .= '<tr style="font-size:13px;">
                            <td>' . $ma_donhang . '</td>
                            <td>' . number_format($bill['tong_thanhtoan']) . ' VNĐ</td>
                            <td>' . $ngay_dat_hang . '</td>
                            <td style="color:green;">' . $status_text . '</td>
                            <td><a href="index.php?pg=profile-user&act=order-chitiet&id_bill=' . $bill['id'] . '">Xem</a></td>
                            <td>' . renderCancelButton($bill['trangthai'], $bill['id']) . '</td>
                        </tr>';
    }

    return $html_dsbill;
}
function getStatusText($status) {
    switch ($status) {
        case 0:
            return '<strong style="color:black">Chờ Xác Nhận</strong>';
        case 1:
            return '<strong style="color:red">Đã Xác Nhận</strong>';
        case 2:
            return '<strong style="color:blue">Đang Giao Hàng</strong>';
        case 3:
            return '<strong style="color:green">Đã Nhận Hàng</strong>';
        case 4:
            return '<strong style="color:gray">Đã Hủy</strong>';
        default:
            return '<strong style="color:black">Chờ Xác Nhận</strong>';
    }
}

function show_bill_admin($dsbill) {
    $html_dsbill = '';
  
    foreach ($dsbill as $bill) {

        $html_dsbill .= '<tr>
                            <td>'.$bill['id'].'</td>
                            <td>'.$bill['id_user'].'</td>
                            <td>'.$bill['ma_donhang'].'</td>
                            <td>'.$bill['nguoinhan_ten'].'</td>
                            <td>'.$bill['nguoinhan_diachi'].'</td>
                            <td>'.$bill['nguoinhan_sdt'].'</td>
                            <td>'.number_format($bill['tong_thanhtoan']).'</td>
                            <td>'.$bill['ngay_dat_hang'].'</td>
                            <td>
                                <form action="index.php?pg=order" method="post" onsubmit="return confirm(\'Bạn chắc chắn muốn thay đổi trạng thái?\')">
                                    <input type="hidden" name="bill_id" value="'.$bill['id'].'">
                                    <select name="new_status" class="custom-select">
                                        <option value="0" class="status-1" '.($bill['trangthai'] == 0 ? 'selected' : '').'>Mới Nhận</option>
                                        <option value="1" class="status-1" '.($bill['trangthai'] == 1 ? 'selected' : '').'>Đang Xử Lý</option>
                                        <option value="2" class="status-2" '.($bill['trangthai'] == 2 ? 'selected' : '').'>Vận Chuyển</option>
                                        <option value="3" class="status-3" '.($bill['trangthai'] == 3 ? 'selected' : '').'>Giao Hàng Thành Công</option>
                                        <option value="4" class="status-4" '.($bill['trangthai'] == 4 ? 'selected' : '').'>Hủy Đơn</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                                </form>
                            </td>
                        </tr>';
    }
    return $html_dsbill;
}

function update_bill_status($bill_id, $new_status) {
    $sql = "UPDATE bill SET trangthai = ? WHERE id = ?";
    return pdo_execute($sql, $new_status, $bill_id);
}

function show_bill_new($dsbill) {
    $html_dsbill = '';
    foreach ($dsbill as $bill) {
        $html_dsbill .= '<tr>
                                <td>' . $bill['ma_donhang'] . '</td>
                                <td>' . ($bill['trangthai'] == 0 ? 'Chờ xác nhận' : ($bill['trangthai'] == 1 ? 'Đã xác nhận' : ($bill['trangthai'] == 2 ? 'Đang vận chuyển' : ($bill['trangthai'] == 3 ? 'Giao hàng thành công' : 'Hủy đơn')))) . '</td>
                        </tr>';
    }
    return $html_dsbill;
}

function add_bill($id_user, $ma_donhang, $ten, $diachi, $sdt, $email, $pt_thanhtoan, $ship, $tongtien,$ngay_dat_hang,$ngay_nhan_hang, $notes) {
    $sql = "INSERT INTO bill(id_user, ma_donhang,  nguoinhan_ten, nguoinhan_diachi, nguoinhan_sdt, nguoinhan_email, pt_thanhtoan,ship, tong_thanhtoan,ngay_dat_hang,ngay_nhan_hang, order_notes, trangthai) VALUES (?,?,?,?,?,?,?,?,?,?,?,?, 0);";
    return pdo_execute($sql, $id_user, $ma_donhang, $ten, $diachi, $sdt, $email, $pt_thanhtoan, $ship, $tongtien,$ngay_dat_hang,$ngay_nhan_hang, $notes);
}

function add_bill_chitiet($id, $id_user) {
    $sql = "INSERT INTO billchitiet (id_bill, id_product, id_user, so_luong, gia, thanh_tien)
            SELECT bill.id, giohang.id_product, giohang.id_user ,giohang.soluong, giohang.gia, giohang.thanhtien
            FROM giohang INNER JOIN user
            ON giohang.id_user = user.id
            INNER JOIN bill
            ON user.id = bill.id_user
            WHERE bill.id = ? AND bill.id_user = ?";
    return pdo_execute($sql, $id, $id_user);
}

function get_id_bill() {
    $sql = "SELECT id FROM bill WHERE 1 ORDER BY id DESC limit 1";
    return pdo_query_one($sql);
}

function get_tongtien_dhtc() {
    $sql = "SELECT SUM(tong_thanhtoan) AS tongtien_giaohangthanhcong FROM bill WHERE trangthai = 3";
    return pdo_query_one($sql);
}
?>
