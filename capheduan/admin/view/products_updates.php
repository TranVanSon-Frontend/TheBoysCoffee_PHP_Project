<div class="main-content">
                <h3 class="title-page">
                    Cập nhật sản phẩm
                </h3>
                <form class="addPro" action="index.php?pg=products_updates&id_updates=<?=$old_values[0]['id']?>" method="POST">
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình ảnh</label>
                        <input type="file" name="img" class="col-form-label" id="img" value="<?= $old_values[0]['hinh'];?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm" value="<?= $old_values[0]['ten_sp'];?>">
                        <input type="hidden" name="id" value="<?=$old_values[0]['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="categories">Danh mục:</label>
                        <select class="form-select" name="categories" aria-label="Default select example">
                            <option selected><?= $old_values[0]['id_catalog'];?></option>
                            <option value="1">Áo Thun Tay Dài</option>
                            <option value="2">Áo Khoác Không Có Nón</option>
                            <option value="3">Áo Polo</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá gốc:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá gốc" value="<?= $old_values[0]['gia'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price_sale">Giá khuyến mãi:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" name="price_sale" id="price_sale" class="form-control"
                                placeholder="Giá khuyến mãi" value="<?= $old_values[0]['giam_gia'];?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 1</label>
                        <input type="file" name="img1" class="col-form-label" id="img1" value="<?= $old_values[0]['hinh1'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 2</label>
                        <input type="file" name="img2" class="col-form-label" id="img2" value="<?= $old_values[0]['hinh2'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 3 </label>
                        <input type="file" name="img3" class="col-form-label" id="img3" value="<?= $old_values[0]['hinh3'];?>">
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày nhập hàng:</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?= $old_values[0]['ngay_nhap'];?>">
                    </div>
                    <div class="form-group">
                        <label>Mô tả sản phẩm</label>
                        <textarea class="form-control" name="description" rows="3"
                            placeholder="Nhập 1 đoạn mô tả về sản phẩm" style="height: 78px;" ><?= $old_values[0]['mo_ta'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="special">Đặc biệt:</label>
                        <select class="form-select" name="special" aria-label="Default select example">
                            <option selected><?= $old_values[0]['dac_biet'];?></option>
                            <option value="1">Hot</option>
                            <option value="2">New</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="view">Lượt xem:</label>
                        <input type="number" class="form-control" name="view" id="view" value="0" value="<?= $old_values[0]['so_luot_xem'];?>">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Nhập mã sản phẩm" value="<?= $old_values[0]['ma_sp'];?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Cập Nhật"></input>
                    </div>
                </form>
            </div>