// Hiện/ẩn menu đăng nhập
function login() {
  var e = document.getElementById("menu_login");

  // Hiện tra phần tử hiện thị hay không
  if (e.style.display == "block") {
    e.style.display = "none";
  } else {
    e.style.display = "block";
  }
  // Thêm sự kiện click cho toàn bộ trang
  document.addEventListener("click", function (event) {
    var e = document.getElementById("menu_login");
    var loginButton = document.getElementById("dropdownButton");

    // Kiểm tra nếu click bên ngoài menu và nút mở
    if (!e.contains(event.target) && !loginButton.contains(event.target)) {
      e.style.display = "none"; // Ẩn menu nếu click ra ngoài
    }
  });
}

// Hiện thị phần Quản lý bảo mật
function toggleSubmenu() {
  // Tìm tất cả các dropdown-submenu
  var dropdowns = document.querySelectorAll(".dropdown-submenu");

  dropdowns.forEach(function (dropdown) {
    // Khi hover vào dropdown, hiển thị menu con
    dropdown.addEventListener("mouseover", function () {
      var menu = this.querySelector(".dropdown-menu");
      menu.style.display = "block"; // Hiển thị menu con khi hover
    });

    // Khi mouse ra khỏi dropdown, ẩn menu con
    dropdown.addEventListener("mouseout", function () {
      var menu = this.querySelector(".dropdown-menu");
      menu.style.display = "none"; // Ẩn menu con khi không hover
    });
  });
}

// Mở/đóng giới thiệu của các trang
document.getElementById("btn_introduce").addEventListener("click", function () {
  var content = document.getElementById("fake_conten");
  var button = this; // Lấy nút hiện tại

  // Kiểm tra xem nội dung đang hiển thị hay không
  if (content.style.display === "none") {
    content.style.display = "block"; // Hiển thị nội dung
    button.textContent = "Bấm để hiện giới thiệu"; // Thay đổi chữ thành "Ẩn"
  } else {
    content.style.display = "none"; // Ẩn nội dung
    button.textContent = "Bấm để ẩn giới thiệu"; // Thay đổi chữ thành "Hiện"
  }
});
