<div class="content">
    <h2>Danh sách người dùng</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php echo show_user($users); ?>
        </tbody>
    </table>
</div>