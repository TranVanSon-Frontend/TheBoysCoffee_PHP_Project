<?php
    $html_dssp_admin = show_sp_admin($dssp);
?>

<div class="main-content">
                <h3 class="title-page">
                    Sản phẩm
                </h3>
                <div class="d-flex justify-content-end">
                    <a href="index.php?pg=products_add" class="btn btn-primary mb-2">Thêm sản phẩm</a>
                </div>
                <table id="example" class="table table-striped" style="width:100%" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình Ảnh</th>
                            <th>Tên </th>
                            <th>Giá</th>
                            <th>Sale</th>
                            <th>Ngày Nhập</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$html_dssp_admin;?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>