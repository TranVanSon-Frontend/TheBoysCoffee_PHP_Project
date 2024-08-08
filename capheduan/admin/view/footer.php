<script src="js/main.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <!-- biểu đồ -->
    <script>
        // Lấy dữ liệu từ PHP (điều chỉnh đường dẫn tương ứng)
        <?php
        $bestSellingProducts = getBestSellingProducts();
        $data = json_encode($bestSellingProducts);
        echo "var productData = $data;";
        ?>

        // Chuẩn bị dữ liệu cho biểu đồ và bảng
        var labels = productData.map(item => item.ten_sp);
        var data = productData.map(item => item.total_sold);
        var colors = Array.from({ length: labels.length }, () => getRandomColor());

        // Vẽ biểu đồ bằng Chart.js
        var ctx = document.getElementById('productChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng bán',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                },
                indexAxis: 'y', // Hiển thị chiều ngang
                maxBarThickness: 50 // Độ rộng tối đa của cột
            }
        });

        // Thêm dữ liệu vào bảng HTML
        var tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        for (var i = 0; i < labels.length; i++) {
            var row = tableBody.insertRow(i);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = labels[i];
            cell2.innerHTML = data[i];
        }

        // Hàm tạo màu ngẫu nhiên
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>