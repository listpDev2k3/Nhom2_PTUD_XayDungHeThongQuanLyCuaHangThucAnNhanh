<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Kí Tài Khoản</title>

  </head>
  <style>
    * {
      margin: 0;
    }

    @font-face {
      font-family: "Quicksand";
      src: url("../font/Montserrat,Quicksand,Tilt_Neon/Quicksand/Quicksand-VariableFont_wght.ttf") format("truetype");
      font-style: normal;
    }
    html,
    body {
      font-family: "Quicksand";
    }

    a {
      text-decoration: none;
      color: rgba(185, 170, 170, 0.593);
    }

    section .background {
      position: relative;
    }
    section .background img {
      width: 100%;
      height: 120vh;
      -o-object-fit: cover;
        object-fit: cover;
      filter: brightness(0.5);
      overflow: hidden;
    }
    section .content {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 40%;
      width: 576px;
      height: 115vh;
      transform: translateX(-50%);
      background-color: rgba(26, 25, 25, 0.6392156863);
      padding: 0px 28px 28px;
      box-shadow: 0px -4px 1px #000000;
      color: rgba(255, 255, 255, 0.8549019608);
    }
    section .content .title {
      font-size: 20px;
      width: calc(100% - 100px);
      padding: 12px 16px;
      border-radius: 12px;
      margin: 4px 28px 0px;
      color: rgba(255, 255, 255, 0.832);
      border: 1px solid white;
      text-align: center;
      padding: 20px 20px;
      border: none;
      margin-bottom: 0;
    }
    section .content .title h1 {
      font-size: 42px;
      padding: 12px;
    }
    section .content .title h6 {
      font-size: 18px;
    }
    section .content form label {
      margin: 20px 30px 8px;
      font-size: 20px;
      color: rgba(185, 170, 170, 0.593);
    }
    section .content form input {
      background-color: #3b3b3b;
      font-size: 20px;
      width: calc(100% - 100px);
      padding: 12px 16px;
      border-radius: 12px;
      margin: 4px 28px 0px;
      color: rgba(255, 255, 255, 0.832);
      border: 1px solid white;
      height: 26px;
    }
    section .content form div {
      margin: 8px 36px;
    }
    section .content form div span {
      color: #d70018;
    }
    section .content form button {
      font-size: 20px;
      width: calc(100% - 100px);
      padding: 12px 16px;
      border-radius: 12px;
      margin: 4px 28px 0px;
      color: rgba(255, 255, 255, 0.832);
      border: 1px solid white;
      height: 54px;
      width: 510px;
      cursor: pointer;
      color: rgba(255, 255, 255, 0.8941176471);
      background-color: #d70018;
      margin: 20px 28px;
      border: red;
    }
    section .content form button:hover {
      background-color: rgba(43, 41, 41, 0.9411764706);
      transition: all 0.3s ease-in-out;
    }
    section .content .line {
      position: relative;
      height: 20px;
      width: 100%;
      padding-bottom: 12px;
    }
    section .content .line div {
      margin-left: 30%;
      height: 100%;
      width: 230px;
      background-color: rgb(167, 177, 187);
      border-radius: 20px;
    }
    section .content .line:before {
      content: "";
      height: 1px;
      width: 553px;
      position: absolute;
      left: 12px;
      top: 8px;
      background-color: rgb(167, 177, 187);
    }
    section .content .log__in {
      display: flex;
      justify-content: space-around;
      align-items: center;
      width: 100%;
      font-size: 20px;
    }
    section .content .log__in div {
      width: 180px;
      padding: 20px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.474);
      border-radius: 24px;
    }
    section .content .log__in div:hover {
      background-color: #3b3b3b;
      transition: all 0.3s ease-in-out;
    }/*# sourceMappingURL=dangKi.css.map */
  </style>
  <body>
    <section>
      <div class="background">
        <img src="images/hero-bg.jpg" alt="Ảnh nền " />
      </div>
      <div class="content">
        <div class="title items">
          <h1>Đăng Kí</h1>
          <h6>
            <a href="index.php">Trang chủ</a> / Đăng kí tài khoản
          </h6>
        </div>
        <form method="post" action="server/register_user.php">
          <label for="HoTen">Họ Tên</label>
          <input
            id="name"
            type="text"
            name="HoTen"
            placeholder="Nguyễn Văn A"
            onblur="validate(value, id, name)"
          />
          <div><span class="text-name"></span></div>
          <label for="phone__number">Số Điện Thoại</label>
          <br />
          <input
            id="phone__number"
            type="text"
            name="SoDienThoai"
            placeholder="0123456789"
            onblur="validate(value, id, name)"
          />
          <div>
            <span class="text-phone__number"></span>
          </div>
          <label for="email">Email</label>
          <br />
          <input
            id="email"
            type="email"
            name="email"
            placeholder="NguyenVanA@gmail.com"
            onblur="validate(value, id, name)"
          />
          <div><span class="text-email"></span></div>
          <label for="password">Mật Khẩu</label>
          <br />
          <input
            id="password"
            type="password"
            name="password"
            placeholder="Abc123"
            onblur="validate(value, id, name)"
          />
          <div><span class="text-password"></span></div>
          <label for="resut-password">Nhập Lại Mật Khẩu</label>
          <br />
          <input
            id="resut-password"
            type="password"
            name="resut-password"
            placeholder="Abc123"
            onblur="validate(value, id, name)"
          />
          <div><span class="text-resut-password"></span></div>
          <button class="btn" type="submit" name="signUp">Đăng Kí </button>
        </form>
        <div class="line">
          <div></div>
        </div>
        <div class="log__in">
          <div>
            <a href="dang_nhap.php">Đăng Nhập</a>
          </div>
          <div>
            <a href="index.php">Trang Chủ</a>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
<script>
  const validate = (value, id, name) => {
    const textError = document.getElementsByClassName("text-" + id)[0];

    const getPattern = (id) => {
      switch (id) {
        case "password":
          return /^[a-zA-Z0-9!@#$%^&*()_]{6,20}$/;
        case "name":
          return /^[\p{L}\s]{8,30}$/u;
        case "phone__number":
          return /^0[1-9]\d{8}$/;
        case "email":
          return /^[\w.-]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        default:
          return null;
      }
    };

    // Kiểm tra trường "Nhập lại mật khẩu"
    if (id === "resut-password") {
      const passwordValue = document.getElementById("password").value;
      if (passwordValue !== value) {
        textError.innerHTML = "Nhập Lại Password Không Đúng !";
        return;
      } else {
        textError.innerHTML = "";
        return;
      }
    }

    // Kiểm tra trường bị để trống
    if (value.trim() === "") {
      textError.innerHTML = "Vui lòng nhập trường này !";
      return;
    }

    // Kiểm tra định dạng của trường
    const pattern = getPattern(id);
    if (pattern && !pattern.test(value.trim())) {
      switch (id) {
        case "name":
          textError.innerHTML = "Vui lòng nhập từ 8 đến 30 ký tự, chỉ bao gồm chữ và khoảng trắng.";
          break;
        case "password":
          textError.innerHTML = "Password có độ dài từ 6 đến 20 ký tự.";
          break;
        case "phone__number":
          textError.innerHTML = "Số điện thoại phải bắt đầu bằng 0 và bao gồm 10 chữ số.";
          break;
        case "email":
          textError.innerHTML = "Định dạng email: abc@xxx.yy";
          break;
        default:
          textError.innerHTML = "Trường này không hợp lệ.";
      }
    } else {
      textError.innerHTML = "";
    }
  };

</script>