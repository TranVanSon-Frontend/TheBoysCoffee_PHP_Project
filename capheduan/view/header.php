<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Boys Coffee</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles-lit.css">
    <link rel="stylesheet" href="styles-user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>
<?php 
if (is_user_logged_in()){
    $user_profile = get_user_by_username($_SESSION['name']);
    $ds_cart_user = get_cart_user($_SESSION['id_user']);
    $count_cart = get_count_cart($_SESSION['id_user']);
    $cart_quantity = $count_cart['soluong_cart'];
    $background_style = $cart_quantity > 0 ? 'background-color:red;' : '';
} else {
    $cart_quantity = 0;
    $background_style = '';
}
$dsdm = danhmuc_all();
?>
    <!--------------header----------->
    <div class="all-header">
    <header class="header" style="display:flex;">
    
              <div class="logo">
                    <a href="index.php"><img src="img/logo.png" alt="EGA Coffee" style="width:450px;height:130px;"></a>
                </div>
    <div style="margin:0px; ">
        <div class="header-1">    
        <div class="header-top">
            <div class="container">
                
                <form action="index.php?pg=shop" method="POST" >
                
                    <input type="text" name="kyw" placeholder="Tìm Kiếm" style="width:450px;height:44px;padding:0px; border:none; border-radius:5px 0px 0px 5px;">
                    <input type="hidden" name="pg" value="shop">
                    <button type="submit" name="timkiem" value="Tìm kiếm" style="height:44px;width:63px; background-color:#8B7046;border:none;color:#ffffff;border-radius:0px 5px 5px 0px;"><i class="fas fa-search" style="font-size:19px;padding:0px;margin-bottom:5px;"></i></button>
                
                </form>
               
            
                <div class="contact-info">
                    <span>Gọi mua hàng: <strong>19006750</strong></span>
                </div>
                <?php if (is_user_logged_in()): ?>
                <div class="user-options">
                    <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                    <a href="index.php?pg=cart"><i class="fas fa-shopping-cart"></i></a>
                    <?php
                    echo '<div style="border-radius:50px; ' . $background_style . '; width:13px; height:13px; text-align:center;  position: relative;"><span class="cart-quantity" style="color:#fff;font-size:9px; position:absolute; left: 4px;bottom:2px;">' . $cart_quantity . '</span></div>';
                    ?>
                    <a href="index.php?pg=profile-user" style="margin:0px;"><i><img src="images/<?=$user_profile['hinh'] ?>"  alt='' style="box-sizing:border-box; border-radius:50px; height:25px;width:25px;"></i></a>
                    <a href="index.php?pg=dangxuat" style="font-size: 15px;margin-left:5px;">Đăng xuất</a>
                    
                </div>

                <?php else: ?>
                <div class="user-options">
                    <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                    <a href="index.php?pg=cart"><i class="fas fa-shopping-cart"></i></a>    
                    <i class="fas fa-user" style="padding-left: 15px;"> </i>              
                    <a href="index.php?pg=dangnhap" style="font-size: 15px;" >Đăng nhập</a>    
                </div>
                <?php endif; ?>
            </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <!-- <button class="product-category">
                    <i class="fas fa-bars"></i><a href="index.php?" style="text-decoration:none; color:#ffffff; padding-left:10px;"> Danh mục sản phẩm</a> 
                    <div class="submenu">
               
            </div>      
                </button> -->
                
                <nav class="main-nav">
                    <ul>
                        <li><a href="index.php?pg=about-us">Giới thiệu</a></li>
                        <li><a href="#">Chương trình khuyến mãi</a></li>
                        <li><a href="index.php?pg=contact">Liên hệ</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="index.php?pg=shop">Hệ thống cửa hàng</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        
    </div>
    </header>
</div>
</body>
</html>
