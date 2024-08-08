<?php
require_once 'pdo.php';
/**
 * Lấy các hình ảnh của banner đang hoạt động (is_active = 1)
 * @return array mảng các banner đang hoạt động
 */
function get_active_banners() {
    $sql = "SELECT image_url FROM banners WHERE is_active = 1";
    return pdo_query($sql);
}
function show_active_banners($ds_banners){
$html_show_banners="";
if (is_array($ds_banners) && count($ds_banners) > 0) {
   foreach($ds_banners as $banners){
$html_show_banners .='<div class="items">
                <img src="img-banners/'.$banners['image_url'].'" alt="die img">
            </div>';
   }
}
return $html_show_banners;
}
function add_banner($title, $image_url, $start_date,$user_id) {
    $sql = "INSERT INTO banners (title, image_url, start_date, is_active,user_id) VALUES (?, ?, ?, 0,?)";
    pdo_execute($sql, $title, $image_url, $start_date,$user_id);
}
function get_all_banners() {
    $sql = "SELECT * FROM banners";
    return pdo_query($sql);
}
function update_banner_status($banner_id, $is_active) {
    $sql = "UPDATE banners SET is_active = ? WHERE id = ?";
    pdo_execute($sql, $is_active, $banner_id);
}
function delete_banner_by_id($banner_id) {
    $sql = "DELETE FROM banners WHERE id = ?";
    pdo_execute($sql, $banner_id);
}


function check_order_exists($id_product)
{
    $sql = 'SELECT COUNT(*) FROM billchitiet WHERE id_product = ?';
    return pdo_query_value($sql, $id_product) > 0;
}
function check_products_exists($id_catalog){
    $sql ='SELECT COUNT(*) FROM sanpham WHERE id_catalog=?';
    return pdo_query_value($sql,$id_catalog) > 0;
}



function update_banner($id, $title, $image_url, $start_date) {
    $sql = "UPDATE banners SET title = ?, image_url = ?, start_date = ? WHERE id = ?";
    try {
        pdo_execute($sql, $title, $image_url, $start_date, $id);
    } catch (Exception $e) {
        throw new Exception("Lỗi khi cập nhật banner: " . $e->getMessage());
    }
}
function show_banners($banners) {
    $html = '';

    foreach ($banners as $banner) {
        $banner_id = htmlspecialchars($banner['id']);
        $title = htmlspecialchars($banner['title']);
        $imageUrl = htmlspecialchars($banner['image_url']);
        $startDate = htmlspecialchars($banner['start_date']);
        $isActive = $banner['is_active'] ? 'Có' : 'Không';
        $toggleActive = $banner['is_active'] ? 0 : 1;
        $toggleText = $banner['is_active'] ? 'Hủy kích hoạt' : 'Kích hoạt';
        $rowClass = $banner['is_active'] ? 'active-banner' : '';

        $html .= <<<HTML
            <tr class="{$rowClass}">
                <td>{$banner_id}</td>
                <td>{$title}</td>
                <td><img src="img-banners/{$imageUrl}" alt="Banner Image" width="100px"></td>
                <td>{$startDate}</td>
                <td >{$isActive}</td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="banner_id" value="{$banner_id}">
                        <input type="hidden" name="is_active" value="{$toggleActive}" >
                        <input type="submit" name="update_status" value="{$toggleText}" >
                    </form>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="banner_id" value="{$banner_id}">
                        <input type="submit" name="delete_banner" value="Xóa" style="background-color:red;">
                    </form>
                </td>
                <td>
                    <form method="GET" action="index.php" style="display:inline;">
                        <input type="hidden" name="pg" value="banner_edit">
                        <input type="hidden" name="banner_id" value="{$banner_id}">
                        <input type="submit" value="Sửa" style="background-color:yellow; color:black;">
                    </form>
                </td>
            </tr>
        HTML;
    }

    return $html;
}

?>
