<?php  $html_chitietsp = showchitietsp($spchitiet); 
      $html_dssp_splq = showsp($dssp_lienquan);
      $html_ds_comment_id=show_comment($ds_comment);?>
      <style>
 


</style>
<div class="container-products">
    <?=$html_chitietsp;?>
    </div>
    
<div style="width:1200px;margin:0px auto;">
    <div class="be-comment-block">
        <?php $count_comment=get_count_comment($id);
            echo '<h1 class="comments-title">Bình Luận ('.$count_comment['soluong_comment'].')</h1>';
        ?>
        <?=$html_ds_comment_id?>
        <form class="form-block" action="index.php?pg=products&id=<?=$id?>" method="post">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <textarea class="form-input" name="comment" required="" placeholder="<?php if(!is_user_logged_in()){echo 'Bạn cần đăng nhập để bình luận!';}else{echo 'Bình luận dưới tên '.$user_profile['hoten'].'';}?>"></textarea>
                        <button name="send" type="submit" class="btn btn-primary" style="margin-bottom:60px;padding:14px">Gửi</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="sanphamlienquan">
        <div class="sp-lq-1">
            <h2 style="font-size: 30px;">Sản phẩm liên quan</h2>
            <div class="sp-to-catalog" style="display:flex">
                <?=$html_dssp_splq;?>
            </div>
        </div>
    </div>
    <div class="social-share">
        <a href="#" class="fab fa-facebook"></a>
        <a href="#" class="fab fa-pinterest"></a>
        <a href="#" class="fab fa-twitter"></a>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;
        }
        
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function addToCart(form) {
    var formData = $(form).serialize(); // Lấy dữ liệu từ form

    $.ajax({
        url: 'index.php?pg=cart', // URL của trang xử lý giỏ hàng
        type: 'POST',
        data: formData + '&cart=1', // Thêm tham số `cart=1` để xác định form gửi từ giỏ hàng
        success: function(response) {
            // Xử lý phản hồi từ server
            alert('Sản phẩm đã được thêm vào giỏ hàng');
            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Có lỗi xảy ra, vui lòng thử lại');
        }
    });
}
</script>
