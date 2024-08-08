<?php
    $html_categories_admin = show_danhmuc_admin($dsdm_categories);
?>

<div class="main-content">
                <h3 class="title-page">
                    Danh mục
                </h3>
                <div class="d-flex justify-content-end">
                    <a href="index.php?pg=categories_add" class="btn btn-primary mb-2">Thêm danh mục</a>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Trang Chủ</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$html_categories_admin;?>
                        <!-- <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td>
                                <a href="#" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                <a href="#" class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i> Xóa</a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>