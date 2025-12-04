<!-- Banner -->
<div class="logo col-2 col-md-2">
    <div class="clock" id="clock"></div>
    <a href="?request=home"><img src="./image/Logo bảo tàng.png" alt="Bảo tàng Chiến thắng Điện Biên Phủ" title="Logo Bảo tàng chiến tháng Điện BIên Phủ"></a>
</div>
<div class="col-8 col-md-8">
    <a class="nav-link title" href="?request=home">
        <h1>BẢO TÀNG CHIẾN THẮNG ĐIỆN BIÊN PHỦ</h1>
    </a>
</div>
<div class="star col-2 col-md-2">
    <img src="./image/star.png" alt="Ngôi sao vằng">
</div>
<script>
    // Hàm cập nhập đồng hồ
    function updateClock() {
        const now = new Date();

        // Lấy giờ, phút, giây
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');
        let seconds = now.getSeconds().toString().padStart(2, '0');

        // Hiển thị định dạng HH:MM:SS
        document.getElementById('clock').innerText = `${hours}h ${minutes}p ${seconds}giây`;
    }

    // Gọi lần đầu
    updateClock();
    // Cập nhật mỗi 1 giây
    setInterval(updateClock, 1000);
</script>