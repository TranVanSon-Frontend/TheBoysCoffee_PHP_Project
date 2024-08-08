<div class="main-content">
                <h3 class="title-page">
                    Thêm Danh Mục
                </h3>

                <form class="addPro" action="index.php?pg=categories_add" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên danh mục:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="stt">Số Thứ Tự</label>
                        <input type="text" class="form-control" name="stt" id="stt" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="sethome">Hiển Thị Trang chủ</label>
                        <select class="form-select" name="sethome" aria-label="Default select example">
                            <option selected>Hiển Thị</option>
                            <option value="">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Thêm"></input>
                    </div>
                </form>
</div>