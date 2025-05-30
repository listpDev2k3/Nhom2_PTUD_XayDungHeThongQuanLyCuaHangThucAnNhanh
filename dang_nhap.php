

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&family=Quicksand:wght@500&family=Tilt+Neon&display=swap"
        rel="stylesheet" />

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
        height: 100vh;
        font-family: "Quicksand";
    }

    a {
        text-decoration: none;
        color: rgba(185, 170, 170, 0.593);
    }

    span,
    .last,
    h6 {
        font-size: 18px;
    }

    section #logn_in {
        position: relative;
    }

    section #logn_in img {
        width: 100%;
        height: 100vh;
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
        transform: translateX(-50%);
        background-color: rgba(26, 25, 25, 0.6392156863);
        padding: 28px;
        box-shadow: 0px -4px 1px #000000;
        color: rgba(255, 255, 255, 0.8549019608);
    }

    section .content div {
        margin: 8px 28px 20px;
    }

    section .content .first {
        text-align: center;
        padding: 30px !important;
    }

    section .content .first h1 {
        font-size: 42px;
        padding: 12px;
    }

    section .content .phone__number label,
    section .content .password label {
        font-size: 20px;
        color: rgba(185, 170, 170, 0.593);
    }

    section .content .phone__number input,
    section .content .password input {
        background-color: #3b3b3b;
        font-size: 20px;
        width: calc(100% - 100px);
        padding: 12px 16px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.832);
        border: 1px solid white;
        height: 26px;
    }

    section .content .phone__number div,
    section .content .password div {
        margin: 8px;
    }

    section .content .phone__number div span,
    section .content .password div span {
        color: red;
    }

    section .checkbox {
        font-size: 20px;
    }

    section .checkbox input {
        margin-right: 8px;
        width: 18px;
        height: 18px;
    }

    section .logn {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
    }

    .btn {
        height: 52px;
        width: 50%;
        border-radius: 20px;
        font-size: 20px;
        border: 1px solid rgba(255, 255, 255, 0.4588235294);
        cursor: pointer;
        color: rgba(255, 255, 255, 0.7607843137);
        font-family: "Quicksand";
        background-color: #d70018;
    }

    .btn:hover {
        background-color: rgba(177, 172, 172, 0.7176470588);
        transition: all 0.3s ease-in-out;
    }


    
</style>
<body>
    <section>
        <div id="logn_in">
            <img
                src="images/hero-bg.jpg"
                alt="Ảnh nền ">
        </div>
        <div class="content">
            <div class="first">
                <h1>Đăng Nhập</h1>
                <h6><a href="index.php">Trang chủ</a> / Đăng nhập tài khoản</h6>
            </div>
            <form method="post" action="server/signIn_user.php">
                <div class="phone__number">
                    <label for="SoDienThoai">Số Điện Thoại</label>
                    <input
                        id="SoDienThoai"
                        type="text"
                        name="SoDienThoai"
                        placeholder="0123456789"
                        onblur="validate(value, id, name)">
                    <div><span class="text-phone__number"></span></div>
                </div>

                <div class="password">
                    <label for="password">Mật Khẩu</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Abc123"
                        onblur="validate(value, id, name)">
                    <div><span class="text-password"></span></div>
                </div>


                <div class="checkbox">
                    <input id="remember" type="checkbox" name="remember">
                    <label for="remember">Nhớ đăng nhập</label>
                </div>

                <div class="logn">
                    <button type="submit" class="btn" name="signIn">Đăng Nhập</button>
                    <a href="#">Quên mật khẩu?</a>
                </div>
                <div class="last">
                    <span>Bạn Chưa Có Tài Khoản?</span>
                    <a href="dang-ki.php">Đăng Kí</a>
                </div>
            </form>
        </div>
        
    </section>
</body>

</html>

