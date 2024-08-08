<div class="main-content">
                <h3 class="title-page">
                    Cập Nhật Danh Mục
                </h3>

                <form class="addPro" action="index.php?pg=categories_updates&id_updates=<?=$old_values[0]['id']?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên danh mục:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $old_values[0]['ten_loai'];?>">
                        <input type="hidden" name="id" value="<?=$old_values[0]['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="stt">Số Thứ Tự</label>
                        <input type="text" class="form-control" name="stt" id="stt" value="<?= $old_values[0]['stt'];?>">
                    </div>
                    <div class="form-group">
                        <label for="sethome">Hiển Thị Trang chủ</label>
                        <select class="form-select" name="sethome" value="<?= $old_values[0]['sethome'];?>" aria-label="Default select example">
                            <option value="">Không</option>
                            <option value="1">Có</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Cập Nhật"></input>
                    </div>
                </form>
</div>