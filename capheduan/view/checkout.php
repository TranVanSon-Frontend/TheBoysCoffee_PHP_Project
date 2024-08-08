<div>
    <form class="row contact_form" action="index.php?pg=dhthanhcong" method="post" id="checkout_form" novalidate="novalidate" onsubmit="return validateForm()">
        <div class="bill-container">
            <div class="column">
                <h2>Thông tin nhận hàng</h2>
                <?php
                if ($is_user_logged_in) {
                    $user_info = get_user_by_id($_SESSION['id_user']);
                ?>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="nguoinhan_email" value="<?php echo $user_info['email']; ?>" required>
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="nguoinhan_ten" value="<?php echo $user_info['hoten']; ?>" required>
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="nguoinhan_sdt" value="<?php echo $user_info['dienthoai']; ?>" required>
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="nguoinhan_diachi" value="<?php echo $user_info['diachi']; ?>" required>
                    <label for="notes">Ghi chú (tùy chọn)</label>
                    <div style="padding-top:10px;"><label for="delivery-time">Thời gian nhận hàng</label>
                        <select id="delivery-time" name="delivery_time" required>
                            <option value="">Chọn thời gian</option>
                            <option value="morning">Buổi sáng</option>
                            <option value="afternoon">Buổi chiều</option>
                            <option value="evening">Buổi tối</option>
                        </select>
                        </div>
                    <textarea id="notes" name="order_notes" rows="3"></textarea>
                    

                <?php
                }
                ?>
            </div>
            <div class="column">
                <h2>Vận chuyển</h2>
                <div class="shipping-info">
                    <p style="background-color: #d1ecf1; color:#0c5460; padding:15px 15px; border-radius:5px;">Vui lòng nhập thông tin giao hàng</p>
                </div>
                <h2>Thanh toán</h2>
               
                <input type="radio" id="manual"  name="pt_thanhtoan" value="1" onchange="updateShippingFee()" required>
                <label for="manual">Thanh toán trực tuyến trước khi giao hàng (OP) </label><br>
                <input type="radio" id="cod"  name="pt_thanhtoan" value="0" onchange="updateShippingFee()" required>
                <label for="cod">Thanh toán khi giao hàng (COD)</label>
               
                <div class="date-order" style="border-top:1px solid #333;padding-top:30px;">
                        <label for="delivery-date" style="color:black;font-size:20px;">Ngày nhận hàng</label>
                        <input type="date" id="delivery-date" name="delivery_date" value="2024-07-28" required>
                        <input type="hidden" id="ngay_dat_hang" name="ngay_dat_hang" required>
                    </div>
            </div>
            <div class="column">
                <div class="order-summary">
                    <h2>Đơn hàng</h2>
                    <div class="order-item">
                        <?php
                        foreach ($ds_cart_user as $item) {
                            $ten_sp = strlen($item['ten_sp']) > 60 ? substr($item['ten_sp'], 0, 50) . '...' : $item['ten_sp'];
                            echo '
                                <img src="images/' . $item['hinh'] . '" alt="Product Image">
                                <div>
                                    <span>' . $ten_sp . '</span><br>
                                    <span>' . number_format($item['thanhtien']) . '</span>
                                </div>';
                        }
                        ?>
                    </div>
                    
                    <div class="total">
                        <span>Tạm tính</span>
                        <span id="subtotal"><?php $sum_cart = get_sum_cart($_SESSION['id_user']);
                                            echo number_format($sum_cart['tong_cart']); ?> VNĐ</span>
                    </div>
                    <div class="total" style="border:none; margin:0px;">
                        <span>Phí vận chuyển</span>
                        <span id="shipping-fee">-</span>
                    </div>
                    <div class="total">
                        <span>Tổng cộng</span>
                        <span id="total"><?php echo number_format($sum_cart['tong_cart']); ?> VNĐ</span>
                    </div>
                    <input type="hidden" name="tongtien" id="tongtien" value="<?php echo $sum_cart['tong_cart']; ?>">
                    <input type="hidden" name="ship" id="ship" value="">
                    <input type="submit" name="thanhtoan" class="btn" value="Đặt Hàng">

                </div>
                <a href="index?pg=cart" class="back-to-cart"> Quay về giỏ hàng</a>
            </div>
        </div>
    </form>
</div>

<script>
    function validateForm() {
        const form = document.getElementById('checkout_form');
        const email = form['nguoinhan_email'].value;
        const name = form['nguoinhan_ten'].value;
        const phone = form['nguoinhan_sdt'].value;
        const address = form['nguoinhan_diachi'].value;
        const payment = form['pt_thanhtoan'].value;
        const deliveryTime = form['delivery_time'].value;
        const deliveryDate = form['delivery_date'].value;
        const orderDate = form['ngay_dat_hang'].value;

        if (!email || !name || !phone || !address || !payment || !deliveryTime || !deliveryDate) {
            alert('Vui lòng nhập đầy đủ thông tin (trừ ghi chú).');
            return false;
        }

        const phonePattern = /^[0-9]{10,11}$/;
        if (!phonePattern.test(phone)) {
            alert('Số điện thoại không hợp lệ.');
            return false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert('Email không hợp lệ.');
            return false;
        }

        const orderDateObj = new Date(orderDate);
        const deliveryDateObj = new Date(deliveryDate);
        const diffTime = deliveryDateObj - orderDateObj;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays < 3) {
            alert('Ngày nhận hàng phải sau ngày đặt hàng ít nhất 3 ngày.');
            return false;
        }

        return true;
    }

    function updateShippingFee() {
        const form = document.getElementById('checkout_form');
        const paymentMethod = form['pt_thanhtoan'].value;
        const subtotalElement = document.getElementById('subtotal');
        const shippingFeeElement = document.getElementById('shipping-fee');
        const totalElement = document.getElementById('total');
        const hiddenTotalElement = document.getElementById('tongtien');
        const hiddenShipElement = document.getElementById('ship');

        const subtotal = parseInt(subtotalElement.textContent.replace(/\D/g, ''));
        let shippingFee = 0;

        if (parseInt(paymentMethod) === 0) {
            shippingFee = 25000;
        }

        const total = subtotal + shippingFee;

        shippingFeeElement.textContent = shippingFee > 0 ? shippingFee.toLocaleString() + ' VNĐ' : '-';
        totalElement.textContent = total.toLocaleString() + ' VNĐ';
        hiddenTotalElement.value = total;
        hiddenShipElement.value = shippingFee;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        updateShippingFee();

        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        const formattedDate = year + '-' + month + '-' + day;
        document.getElementById('ngay_dat_hang').value = formattedDate;
        
        const deliveryDateInput = document.getElementById('delivery-date');
        today.setDate(today.getDate() + 3);
        const minDeliveryDate = today.toISOString().split('T')[0];
        deliveryDateInput.min = minDeliveryDate;
    });
</script>
