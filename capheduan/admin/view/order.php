<?php
$html_ds_bill = show_bill_admin($ds_bill);

echo '<div class="main-content">
        <h3 class="title-page">
            Quản lí đơn hàng
        </h3>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã Khách Hàng</th>
                    <th>Mã Đơn Hàng</th>
                    <th>Tên Người Nhận</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>';
echo $html_ds_bill;
echo '</tbody>
        </table>
    </div>
</div>
</div>';
?>
