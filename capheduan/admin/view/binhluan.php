<?php
$html_binhluan = hienThiBinhLuanChoAdmin(layTatCaBinhLuanChoAdmin());
?>
<div class="main-content">
                <h3 class="title-page">
                    Bình luận
                </h3>
                
<table id="example" class="table table-striped" style="width:100%; overflow-x:auto;">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID Sản phẩm</th>
            <th>ID Người dùng</th>
            <th>Nội dung</th>
            <th>Ngày bình luận</th>
        </tr>
    </thead>
    <tbody>
        <?= $html_binhluan; ?>
    </tbody>
</table>

