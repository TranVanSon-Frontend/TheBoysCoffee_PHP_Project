<?php
    $html_dssp_new=showsp($dssp_new);
    $html_dssp_best=showsp($dssp_best);
    $html_dssp_view=showsp($dssp_view);
    $html_sp_banner=showspbanner($banner_caphe);
    $html_sp_banner_may=showspbanner($banner_may_caphe);
    $html_show_banners=show_active_banners($ds_banners);
?>

    <!------------slider----------->
    <div class="slider" style="margin-top:10px">

        <div class="list">
            <?=$html_show_banners;?>
        </div>
        
        <!-----button <>-->
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <div class="waytogo">
        <h4><a href="index.php?pg=shop">Xem thêm >>></a></h4>
      
        </div>
        <!-----dots---->
        
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            
        </ul>
        </div>
        <script src="script.js"></script>
        <br>
        <br>
        <br>
        <br>
        <section class="features">
            <div class="container1">
                <div class="feature">
                    <img src="img/policies_icon_1.webp" alt="Miễn phí vận chuyển">
                    <div class="text-icon">
                        <h3>Miễn phí vận chuyển</h3>
                        <p>Nhận hàng trong vòng 3 ngày</p>
                    </div>
                </div>
                <div class="feature">
                    <img src="img/policies_icon_2.webp" alt="Trả góp siêu ưu đãi 0%">
                    <div class="text-icon">
                        <h3>Trả góp siêu ưu đãi 0%</h3>
                        <p>Hỗ trợ vay lãi xuất thấp và nhanh chóng</p>
                    </div>
                </div>
                <div class="feature">
                    <img src="img/policies_icon_3.webp" alt="Miễn phí vận chuyển">
                    <div class="text-icon">
                        <h3>Đổi trả 30 ngày miễn phí</h3>
                        <p>Sản phẩm đã được kiểm định</p>
                    </div>
                </div>
                <div class="feature">
                    <img src="img/policies_icon_4.webp" alt="Miễn phí vận chuyển">
                    <div class="text-icon">
                        <h3>Hotline hỗ trợ 24/7</h3>
                        <p>Địch vụ hỗ trợ khách hàng 27/7</p>
                    </div>
                </div>
    
            </div>
        </section>
    <br>
    <br>
        <!-- <section class="mini-pro">
            <div class="all-mini">
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div>
                <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div> <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div> <div class="mini">
                    <div class="img-mini"><img src="coll_1.webp" alt="Cà phê"></div>
                    <h3>Cà phê</h3>
                </div> 
    
            </div>
        </section> -->
        <br><br><br><br>
        <div>
        <section class="spu-sales" style="font-size:20px;">
    <h1>🔥TOP SẢN PHẨM CÀ PHÊ TRENDING</h1>
    </section>
    <br>
    <br>
    <section class="banner-coll">
        <?= $html_sp_banner;?>
    </section>
</div>
<br>
<br>
<br>
<br>
<div>
    <section class="spu-sales">
        <h1>🔥 SẢN PHẨM CỰC HOT</h1>
        <br>
        <h5>BẢN TIN KHUYẾN MÃI</h5>
        <div class="text-sub">
            <h5>Giao hàng trong 2h</h5>
            <h5>free ship nội địa</h5>
            <h5>Giảm 30k cho đơn hàng từ 399k</h5>
        </div>
        </section>
</div>

<div>
    <div class="all-card">
    <?=$html_dssp_best;?>
</div>
<div class="cta">
    <a href="index.php?pg=shop">Xem tất cả &raquo;</a>
</div>
</div>

<br>
<div>
    <section class="spu-sales">
        <h1>SẢN PHẨM MỚI</h1>      
        </section>
</div>
<br>
<div>
    <div class="all-card">
     <?= $html_dssp_new;?>   
    </div>   
</div>
<div class="cta">
    <a href="index.php?pg=shop">Xem tất cả &raquo;</a>
</div>
</div>
<section class="show-3">
     <div class="show-3-1">
        <div class="text">
        <h2>MÁY PHA CÀ PHÊ NESPRESSO ZENUIS</h2>
        <p>Zenius, máy pha cà phê đầu tiên của Nespresso với tất cả các kết nối phù hợp. Lý tưởng cho mọi quy mô doanh nghiệp, nơi chất lượng, trực giác và sự đơn giản đều quan trọng. Nhanh chóng và hiệu quả, cà phê và nước nóng đặc biệt được chuẩn bị nhanh chóng chỉ bằng một nút bấm.</p>
        <div class="cta">
            <a href="index.php?pg=shop">Xem tất cả &raquo;</a>
        </div>
    </div>
    <div class="img">
        <img src="img/show-3.webp">
    </div>   
    </div>
</section>
<br>
<br>
<section class="spu-sales" style="font-size:20px;">
    <h1>🔥TOP MÁY PHA CÀ PHÊ TRENDING</h1>
    
    </section>
    <br>
    <br>
    <section class="banner-coll">
        <?= $html_sp_banner_may;?>
    </section>
<br><br><br><br>
<div>
    <section class="spu-sales" >
        <h1>SẢN PHẨM ĐƯỢC QUAN TÂM </h1>      
        </section>
</div>
<br>
<div>
    <div class="all-card">
    <?=$html_dssp_view;?>
</div>
<div class="cta">
            <a href="index.php?pg=shop">Xem tất cả &raquo;</a>
        </div>
<br><br><br><br>
<section class="hot-banner">
    <div class="img">
        <a href=""><img src="img/section_hot_banner.webp"></a>
    </div>
</section>
<br><br><br><br>
<section class="about-us-home">
    <div class="all-about-home">
        <div class="text">
            <h2>VỀ CHÚNG TÔI EGA COFFEE</h2>
            <p>Đa Dạng Các Loại Cà Phê. Dễ dàng pha các loại cà phê Việt như: cà phê đen, cà phê sữa đá, bạc sỉu, kem béo</p>
            <p>Và các loại cà phê ý như: espresso, capuchino, latte, americano...</p>
            <p>Sản phẩm của chúng tôi được lấy cảm hứng từ những hình dạng và câu chuyện trải dài qua nhiều thế hệ và nền văn hóa</p>
            <p>Mời bạn cùng khám phá gian hàng của chúng tôi nhé...</p>
           <div class="cta">
           <a href="#">KHÁM PHÁ NGAY &raquo;</a>
</div>
        </div>
        <div class="img">
            <img src="img/about-img.webp">
        </div>
    </div>
</section>
<br><br><br><br>
<section class="movie-sto">
    <div class="movie-sto-1">
        <div class="text">
            <h2>CÂU CHUYỆN VỀ MALONGO</h2>
            <p>Cà phê dành cho người sành điệu. Lò nướng từ năm 1934, một xưởng rang cà phê nhỏ hình thành ở trung tâm thị trấn. Cơ sở này ban đầu rang 25 kg mỗi ngày, sau tăng lên 100 kg. Lò rang này được gọi là gì? quán cà phê Malongo.</p>
            <div class="cta">
                <a href="#">KHÁM PHÁ NGAY &raquo;</a>
           </div>
        </div>
        <div class="img">
            <img src="img/section_video_bg.webp">
        </div>
    </div>
</section>
<br><br><br><br>
<section class="cuahang">
        <div class="cuahang-1">
            <img src="img/section_store_bg.webp">
            <div class="box">
                <p>Trải Nghiệm Và Dùng Thử Sản Phẩm</p>
                <h2>TẠI CỬA HÀNG EGA COFFEE</h2>
                <p>Liên hệ hotline hỗ trợ: 19006750</p>
                <div class="cta">
                    <a href="#">KHÁM PHÁ NGAY &raquo;</a>
               </div>
            </div>
        </div>
</section>
<br><br><br><br>
<section class="spu-sales">
    <h1>MẸO CÀ PHÊ HAY</h1>      
    </section>
    <br>
<section class="news-home">
      <div class="news-home-1">
        <div class="news-home-2">
            <img src="img/new-1.webp">
        <h3>Có nên vệ sinh máy pha cà phê thường xuyên?</h3>
        <h5>Thứ Tư, 10/05/2023</h5>
        <p>Vệ sinh máy pha cà phê là công đoạn quan trọng cần được thực hiện hàng ngày, hàng tuần, hàng tháng để đảm bảo sức khỏe...</p>
        </div>
        <div class="news-home-2">
            <img src="img/new-2.webp">
        <h3>Nguyên lý hoạt động của máy pha cà phê Espresso</h3>
        <h5>Thứ Tư, 10/05/2023</h5>
        <p>Chất lượng và hương vị tách espresso cuối cùng chịu ảnh hưởng rất nhiều từ cách mà chiếc máy pha cafe hoạt động. Là một barista...</p>
        </div>  <div class="news-home-2">
            <img src="img/new-3.webp">
        <h3>Tips tăng doanh thu cho các quán kinh doanh cafe</h3>
        <h5>Thứ Tư, 10/05/2023</h5>
        <p>VĐẦU TƯ VÀO ĐÀO TẠO NHÂN VIÊN Yếu tố con người là một trong những yếu tố quan trọng nhất giúp tăng doanh thu quán cafe. Đó có...</p>
        </div>  <div class="news-home-2">
            <img src="img/new-4.webp">
        <h3>Các loại thức uống cà phê Hot hiện nay</h3>
        <h5>Thứ Tư, 10/05/2023</h5>
        <p>Espresso Là loại cafe rất được ưa chuộng tại Ý và Tây Ban Nha; được pha bằng cách cho nước bị ép dưới áp suất cao chảy qua...</p>
        </div>
        
      </div>
</section>
<br><br><br><br>
<div class="w-brand">
    <div class="brand-section">
        <h2>THƯƠNG HIỆU UY TÍN</h2>
        <div class="brands">
            <img src="img/brand_1.webp" alt="Hero">
            <img src="img/brand_2.webp" alt="Staresso">
            <img src="img/brand_3.webp" alt="Zenbrew">
            <img src="img/brand_5.webp" alt="Stoke">
            <img src="img/brand_5.webp" alt="Starbucks">
            <img src="img/brand_6.webp" alt="Nescafe">
            <img src="img/brand_7.webp" alt="Malongo">
        </div>
    </div>
</div>
<div class="w-fag">
    <div class="faq-section">
        <h2>CÂU HỎI THƯỜNG GẶP</h2>
        <div class="faq">
            <div class="faq-item"><a href="#">Máy pha cà phê có dễ sử dụng không?</a></div>
            <div class="faq-item"><a href="#">Chất liệu của sản phẩm?</a></div>
            <div class="faq-item"><a href="#">Tôi nên sử dụng cỡ xay nào?</a></div>
            <div class="faq-item"><a href="#">Làm sao để liên hệ với shop?</a></div>
            <div class="faq-item"><a href="#">Một câu hỏi khác...?</a></div>
        </div>
    </div>
</div>
    <!-- <div class="sidebar">
        <img src="path-to-your-image/phone-icon.png" alt="Phone">
        <img src="path-to-your-image/chat-icon.png" alt="Chat">
        <img src="path-to-your-image/zalo-icon.png" alt="Zalo">
        <img src="path-to-your-image/another-icon.png" alt="Another">
    </div> -->

    <button class="scroll-to-top"></button>

    <script>
        // Scroll to top button functionality
        document.querySelector('.scroll-to-top').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
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
            // Xử lý phản hồi từ server (hiển thị thông báo hoặc cập nhật giao diện)
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

</body>
</html>
