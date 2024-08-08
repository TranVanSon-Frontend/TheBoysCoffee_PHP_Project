<?php
    $html_ds_user = show_user($ds_user);
?>
<div class="main-content">
    <h3 class="title-page">Thành viên</h3>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình Ảnh</th>
                <th>Họ Tên</th>
                <th>Vai Trò</th>
                <th>Tên Đăng Nhập</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?=$html_ds_user;?>
        </tbody>
    </table>
</div>
