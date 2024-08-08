<?php
    $html_bill_new = show_bill_new($ds_bill_new);
    $html_user_new = show_user_new($ds_user_new);
?>


<div class="main-content">
                <h3 class="title-page">
                    Dashboards
                </h3>
                <section class="statistics row">
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="index.php?pg=products">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng sản phẩm
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=get_soluong_sp()?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="index.php?pg=user">
                            <div class="card mb-3 widget-chart">

                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng thành viên
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=get_soluong_user()?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="index.php?pg=categories">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng doanh mục
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=get_soluong_dm()?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="index.php?pg=order">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng đơn hàng
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=get_soluong_bill()?></span>
                            </div>
                        </a>
                    </div>
                </section>
                <section class="row">
                    <div class="col-sm-12 col-md-6 col xl-6">
                        <div class="card chart">
                            <p>Tổng doanh thu:  <span><?php $tongtien = get_tongtien_dhtc(); echo number_format($tongtien['tongtien_giaohangthanhcong']).' VNĐ';?></span></p>
                            <table class="revenue table table-hover">
                                <thead>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Doanh thu</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($ds_bill as $bill){
                                            echo ' <tr>
                                                        <td>'.$i++.'</td>
                                                        <td>'.$bill['ma_donhang'].'</td>
                                                        <td>'.number_format($bill['tong_thanhtoan']).' VNĐ</td>
                                                    </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="index.php?pg=order" style="text-decoration: none; color: #616161; transition: ease-in-out 0.2s all;">
                            <div class="card chart">
                                <h4>Đơn hàng mới</h4>
                                <table class="revenue table table-hover">
                                    <thead>
                                        <th>Mã đơn hàng</th>
                                        <th>Trạng thái</th>
                                    </thead>
                                    <tbody>
                                        <?=$html_bill_new?>
                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>


                    <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="index.php?pg=user" style="text-decoration: none; color: #616161; transition: ease-in-out 0.2s all;">
                        <div class="card chart">
                            <h4>Khách hàng mới</h4>
                            <table class="revenue table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                </thead>
                                <tbody>
                                    <?=$html_user_new?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


