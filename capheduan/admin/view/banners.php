<?php
$show_banners = show_banners($get_banners);
?>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

      

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        form input[type="text"], form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            padding: 10px 15px;
            background-color: #28a745;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .action-button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .activate {
            background-color: #28a745;
            color: #fff;
        }

        .deactivate {
            background-color: #dc3545;
            color: #fff;
        }
        
        #bannerForm {
            display: none; /* Ẩn form ban đầu */
            margin-top: 20px;
        }
        #showFormButton{
            padding:10px;
            border-radius: 5px;
            background-color: #007bff;
            color:#ffff;
            
        }
      

    
    </style>
<body>
    <div class="banner-all" style="width:1500px;margin:0px auto;">
    <div style="margin-left:300px;">
    
    <h1>Quản lý Banner</h1>
    <form method="POST" id="bannerForm" >
        <h2>Thêm Banner</h2>
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" required>
        <br>
        <label for="image_url">URL Hình ảnh:</label>
        <input type="file" name="image_url" id="image_url" required>
        <br>
        <label for="start_date">Ngày bắt đầu:</label>
        <input type="date" name="start_date" required>
      
        <br>
        <input type="submit" name="add_banner" value="Thêm Banner">
    </form>
   <div style="display:flex;justify-content:space-between"><h2>Danh sách Banner</h2><button id="showFormButton">Thêm Banner</button> </div> 
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Ngày bắt đầu</th>
                <th>Kích hoạt</th>
                <th>Hành động</th>
                <th >Xóa</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            <?=$show_banners?>
        </tbody>
    </table>
    </div>
    </div>
</body>
<script>
        // Lấy phần tử nút và form
        const showFormButton = document.getElementById('showFormButton');
        const bannerForm = document.getElementById('bannerForm');

        // Thêm sự kiện khi nhấp vào nút
        showFormButton.addEventListener('click', () => {
            // Đổi thuộc tính display của form giữa none và block
            if (bannerForm.style.display === 'none' || bannerForm.style.display === '') {
                bannerForm.style.display = 'block';
                showFormButton.textContent = 'Tắt';
            } else {
                bannerForm.style.display = 'none';
                showFormButton.textContent = 'Thêm Banner';
            }
        });
    </script>