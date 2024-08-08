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
            width:800px;
            margin:0px auto;
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
<!DOCTYPE html>
<html>
<head>
    <title>Sửa Banner</title>
</head>
<body>
    <h2>Sửa Banner</h2>
    <form method="POST" action="" >
    <input type="hidden" name="banner_id" value="<?php echo htmlspecialchars($banner['id']); ?>">
    <label for="title">Tiêu đề:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($banner['title']); ?>" required>
    <br>
    <label for="image_url">URL Hình ảnh:</label>
    <input type="file" name="image_url" id="image_url" value="<?php echo htmlspecialchars($banner['image_url']); ?>" required>
    <br>
    <label for="start_date">Ngày bắt đầu:</label>
    <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($banner['start_date']); ?>" required>
    <br>
    <input type="submit" name="update_banner" value="Cập nhật Banner">
</form>

</body>
</html>
