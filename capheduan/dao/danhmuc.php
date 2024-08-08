<?php
require_once 'pdo.php';



function add_danhmuc($ten,$stt,$sethome){
    $sql = "INSERT INTO danhmuc (ten_loai, stt, sethome) VALUES (?,?,?);";
    return pdo_execute($sql,$ten,$stt,$sethome);
}

function updates_danhmuc($id,$ten,$stt,$sethome){
    $sql = "UPDATE danhmuc SET id=?, ten_loai= ?, stt=?, sethome=? WHERE id=".$id;
    return pdo_execute($sql,$id,$ten,$stt,$sethome);
}

function delete_danhmuc($id){
    $sql = 'DELETE FROM danhmuc WHERE id= ?;';
    return pdo_execute($sql,$id);
}

function get_soluong_dm(){
    $sql = "SELECT COUNT(id) FROM danhmuc WHERE 1";
    $count = pdo_query_value($sql);
    return $count;
}

function get_danhmuc(){
    $sql = "SELECT * FROM danhmuc WHERE 1";
    return pdo_query($sql);
}

function get_name_catalog($id) {
    $sql = "SELECT ten_loai FROM danhmuc WHERE id=?";
    $dm= pdo_query_one($sql, $id);
    if ($dm && isset($dm["ten_loai"])) {
        return $dm["ten_loai"];
    }
    return ""; // Hoặc giá trị mặc định khác tùy vào yêu cầu của bạn

}

function get_dm_id($id) {
    $sql = "SELECT * FROM danhmuc WHERE id=?";
    return pdo_query($sql, $id);
}

function get_danhmuc_form($dsdm){
    $html_dm = '';
    foreach($dsdm as $dm){
        $html_dm .= '
                        <option value="'.$dm['id'].'">'.$dm['ten_loai'].'</option>
                    ';
    }
    return $html_dm;
}

function show_danhmuc_admin($dsdm){
    $html_dm_admin = '';
    foreach($dsdm as $dm){
        $html_dm_admin .= '<tr>
                                <td>'.$dm['stt'].'</td>
                                <td>'.$dm['ten_loai'].'</td>
                                <td>' . ($dm['sethome'] == 0 ? 'No' : 'Yes') . '</td>
                                <td>
                                    <a href="index.php?pg=categories_updates&id_updates='.$dm['id'].'" class="btn btn-warning"><i
                                            class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="index.php?pg=categories&id_delete='.$dm['id'].'" class="btn btn-danger"><i
                                            class="fa-solid fa-trash"></i> Xóa</a>
                                </td>
                            </tr>';
    }
    return $html_dm_admin;
}

function danhmuc_all(){
    // Xử lý thêm danh mục nếu form được gửi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
        $categoryName = $_POST['categoryName'];
        // Thực hiện thêm danh mục vào cơ sở dữ liệu
        $sql = "INSERT INTO danhmuc (ten_loai, stt) VALUES (:ten_loai, 0)";
        $params = [':ten_loai' => $categoryName];
        pdo_execute($sql, $params);

        // Redirect hoặc hiển thị thông báo thành công
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Truy vấn tất cả các loại sau khi thêm mới (nếu có)
    $sql = "SELECT * FROM danhmuc WHERE sethome = 1 ORDER BY stt ASC";
    return pdo_query($sql);
}

function showdm($dsdm){
    $html_dm = '<ul>';
    foreach ($dsdm as $dm) {
        $link = 'index.php?pg=shop&iddm=' . $dm['id'];
        $html_dm .= '<li><a href="' . $link . '">' . htmlspecialchars($dm['ten_loai']) . '</a></li>';
    }
    $html_dm .= '</ul>';

    // Form thêm danh mục
    $html_dm .= '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">
                    <label for="categoryName">Tên danh mục:</label>
                    <input type="text" id="categoryName" name="categoryName" required>
                    <button type="submit">Thêm Danh Mục</button>
                 </form>';

    return $html_dm;
}

function get_name_dm($id) {
    $sql = "SELECT ten_loai FROM danhmuc WHERE id=?";
    return pdo_query_value($sql, $id);
}

function get_sethome_dm($id) {
    $sql = "SELECT sethome FROM danhmuc WHERE id=?";
    return pdo_query_value($sql, $id);
}
?>
