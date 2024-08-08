<div class="main-content">
                <h3 class="title-page">
                    Thêm sản phẩm
                </h3>
                <form class="addPro" action="index.php?pg=products_add" method="POST">
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình ảnh</label>
                        <input type="file" name="img" class="col-form-label" id="img">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="categories">Danh mục:</label>
                        <select class="form-select" name="categories" aria-label="Default select example">
                            <option selected>Chọn danh mục</option>
                            <?=get_danhmuc_form($dsdm_categories)?>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá gốc:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá gốc">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price_sale">Giá khuyến mãi:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" name="price_sale" id="price_sale" class="form-control"
                                placeholder="Giá khuyến mãi">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 1</label>
                        <input type="file" name="img1" class="col-form-label" id="img1">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 2</label>
                        <input type="file" name="img2" class="col-form-label" id="img2">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label">Hình phụ 3 </label>
                        <input type="file" name="img3" class="col-form-label" id="img3">
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày nhập hàng:</label>
                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <label>Mô tả sản phẩm</label>
                        <textarea class="form-control" name="description" rows="3"
                            placeholder="Nhập 1 đoạn mô tả về sản phẩm" style="height: 78px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="special">Đặc biệt:</label>
                        <select class="form-select" name="special" aria-label="Default select example">
                            <option selected>Chọn danh mục</option>
                            <option value="1">Hot</option>
                            <option value="2">New</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="view">Lượt xem:</label>
                        <input type="number" class="form-control" name="view" id="view" value="0">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Nhập mã sản phẩm">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Thêm"></input>
                    </div>
                </form>
            </div>