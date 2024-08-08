<?php
require_once 'pdo.php';

function comment($id_product, $id_user,  $comment, $ngay_bl){
    $sql = "INSERT INTO binhluan(id_product, id_user,  noi_dung, ngay_bl) VALUES (?,?,?,?)";
    pdo_execute($sql, $id_product, $id_user, $comment, $ngay_bl);
}

function get_all_comment($id){
    $sql = "SELECT * FROM binhluan WHERE id_product=".$id;
    return pdo_query($sql);
}

function get_count_comment($id){
    $sql = "SELECT COUNT(*) AS soluong_comment FROM binhluan WHERE id_product=".$id;
    return pdo_query_one($sql);
}

function get_all_comment_id_sampham($id){
    $sql = "SELECT binhluan.noi_dung, binhluan.ngay_bl, user.hoten
            FROM binhluan INNER JOIN user
            ON binhluan.id_user = user.id
            WHERE binhluan.id_product =".$id;
    return pdo_query($sql);
}

function show_comment($ds_comment){
    $html_comment = "";

    foreach ($ds_comment as $comment) {
        $html_comment .='<div class="be-comment" style="width:1000px;margin:0px auto;">
                            <div class="be-img-comment">
                                <a href="blog-detail-2.html">
                                    <img src="images/user.jpg" alt="" class="be-ava-comment">
                                </a>
                            </div>
                            <div class="be-comment-content">
                                    <span class="be-comment-name">
                                        <a href="blog-detail-2.html">'.$comment['hoten'].'</a>
                                        </span>
                                    <span class="be-comment-time">
                                        <i class="fa fa-clock-o"></i>
                                        '.$comment['ngay_bl'].'
                                    </span>

                                <p class="be-comment-text">
                                '.$comment['noi_dung'].'
                                </p>
                            </div>
                        </div>';
    };

    return $html_comment;
}
function layTatCaBinhLuanChoAdmin(){
    $sql = "SELECT binhluan.id, binhluan.id_product, binhluan.id_user, binhluan.noi_dung, binhluan.ngay_bl, user.hoten
            FROM binhluan INNER JOIN user
            ON binhluan.id_user = user.id";
    return pdo_query($sql);
}

function hienThiBinhLuanChoAdmin($dsBinhLuan) {
    $htmlBinhLuanAdmin = '';
    $i = 0;

    foreach ($dsBinhLuan as $binhLuan) {
        $i++;
        $htmlBinhLuanAdmin .= '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$binhLuan['id_product'].'</td>
                                    <td>'.$binhLuan['id_user'].'</td>
                                    <td>'.$binhLuan['noi_dung'].'</td>
                                    <td>'.$binhLuan['ngay_bl'].'</td>
                                </tr>';
    }

    return $htmlBinhLuanAdmin;
}



?>