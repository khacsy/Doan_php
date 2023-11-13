

<?php
    include ("html.php");
?>
<?php

if (isset($_POST['submit']))
{
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password']) || empty($_POST['cpassword']) || empty($_POST['cpassword']))
    {
        $message = "Không được để trống thông tin";
    }
    else
    {
        //check user xem co bi trung` khong
        $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
        $check_email = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

        if ($_POST['password'] != $_POST['cpassword'])
        {
            $message = "Mật khẩu không trùng khớp";
        }
        elseif (strlen($_POST['password']) < 6)
        {
            $message = "Mật khẩu phải lớn hơn 6 kí tự";
        }
        elseif (strlen($_POST['phone']) < 10)
        {
            $message = "Số điện thoại không hợp lệ";
        }

        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $message = "Email không hợp lệ, xin vui lòng nhập đúng email";
        }
        elseif (mysqli_num_rows($check_username) > 0)
        {
            $message = 'Tên tài khoản đã tồn tại!';
        }
        elseif (mysqli_num_rows($check_email) > 0)
        {
            $message = 'Email này đã tồn tại!';
        }
        else
        {

            //truy xuat du lieu trong database
            $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address,Role) VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "','" . $_POST['address'] . "','".'User'."')";
            mysqli_query($db, $mql);
            $success = "Tạo tài khoản thành công! <p>Bạn sẽ được trở về nới đăng nhập <span id='counter'>5</span> giây(s).</p>
      <script type='text/javascript'>
      function countdown() {
         var i = document.getElementById('counter');
         if (parseInt(i.innerHTML)<=0) {
            location.href = 'login.php';
         }
         i.innerHTML = parseInt(i.innerHTML)-1;
      }
      setInterval(function(){ countdown(); },1000);
      </script>'";
            header("refresh:5;url=login.php");
        }
    }

}

?>

<body>

    <!--header starts-->
<?php
    include ("header.php");
?>
    <div class="page-wrapper">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#" class="active">
                            <span
                                style="color:red;"><?php echo $message; ?></span>
                            <span style="color:green;">
                                <?php echo $success; ?>
                            </span>

                        </a></li>

                </ul>
            </div>
        </div>
        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <!-- REGISTER -->
                    <div class="col-md-8">
                        <div class="widget">
                            <div class="widget-body">

                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="exampleInputEmail1">Tên
                                                tài khoản</label>
                                            <input class="form-control"
                                                type="text" name="username"
                                                id="example-text-input"
                                                placeholder="UserName">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label
                                                for="exampleInputEmail1">Họ</label>
                                            <input class="form-control"
                                                type="text" name="firstname"
                                                id="example-text-input"
                                                placeholder="First Name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label
                                                for="exampleInputEmail1">Tên</label>
                                            <input class="form-control"
                                                type="text" name="lastname"
                                                id="example-text-input-2"
                                                placeholder="Last Name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Địa
                                                chỉ Email</label>
                                            <input type="text"
                                                class="form-control"
                                                name="email"
                                                id="exampleInputEmail1"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter email">
                                            <small id="emailHelp"
                                                class="form-text text-muted">We"ll
                                                never share your email with
                                                anyone else.</small>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Số
                                                điện thoại</label>
                                            <input class="form-control"
                                                type="text" name="phone"
                                                id="example-tel-input-3"
                                                placeholder="Phone"> <small
                                                class="form-text text-muted">We"ll
                                                never share your email with
                                                anyone else.</small>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label
                                                for="exampleInputPassword1">Mật
                                                khẩu</label>
                                            <input type="password"
                                                class="form-control"
                                                name="password"
                                                id="exampleInputPassword1"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label
                                                for="exampleInputPassword1">Nhập
                                                lại mật khẩu</label>
                                            <input type="password"
                                                class="form-control"
                                                name="cpassword"
                                                id="exampleInputPassword2"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="exampleTextarea">Địa chỉ
                                                nơi ở vận chuyển</label>
                                            <textarea class="form-control"
                                                id="exampleTextarea"
                                                name="address"
                                                rows="3"></textarea>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p> <input type="submit"
                                                    value="Đăng Ký"
                                                    name="submit"
                                                    class="btn theme-btn"> </p>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                    </div>
                    <!-- WHY? -->
                    <div class="col-md-4">
                        <h4>Tạp chí & cẩm nang công thức</h4>
                        <p>Các phương thức luôn được đề cập mọi toàn quốc tại
                            Koji Food</p>
                        <hr>
                        <img src="https://res.cloudinary.com/dbmfupfkf/image/upload/v1674445486/cld-sample-4.jpg"
                            alt="" class="img-fluid">
                        <p></p>
                        <div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a
                                        data-parent="#accordion"
                                        data-toggle="collapse"
                                        class="panel-toggle collapsed"
                                        href="#faq1" aria-expanded="false"><i
                                            class="ti-info-alt"
                                            aria-hidden="true"></i>Can I viverra
                                        sit amet quam eget lacinia?</a></h4>
                            </div>
                            <div class="panel-collapse collapse" id="faq1"
                                aria-expanded="false" role="article"
                                style="height: 0px;">
                                <div class="panel-body"> Lorem ipsum dolor sit
                                    amet, consectetur adipiscing elit. Etiam
                                    rutrum ut erat a ultricies. Phasellus non
                                    auctor nisi, id aliquet lectus. Vestibulum
                                    libero eros, aliquet at tempus ut,
                                    scelerisque sit amet nunc. Vivamus id porta
                                    neque, in pulvinar ipsum. Vestibulum sit
                                    amet quam sem. Pellentesque accumsan
                                    consequat venenatis. Pellentesque sit amet
                                    justo dictum, interdum odio non, dictum
                                    nisi. Fusce sit amet turpis eget nibh
                                    elementum sagittis. Nunc consequat lacinia
                                    purus, in consequat neque consequat id.
                                </div>
                            </div>
                        </div>
                        <!-- end:panel -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a
                                        data-parent="#accordion"
                                        data-toggle="collapse"
                                        class="panel-toggle" href="#faq2"
                                        aria-expanded="true"><i
                                            class="ti-info-alt"
                                            aria-hidden="true"></i>Can I viverra
                                        sit amet quam eget lacinia?</a></h4>
                            </div>
                            <div class="panel-collapse collapse" id="faq2"
                                aria-expanded="true" role="article">
                                <div class="panel-body"> Lorem ipsum dolor sit
                                    amet, consectetur adipiscing elit. Etiam
                                    rutrum ut erat a ultricies. Phasellus non
                                    auctor nisi, id aliquet lectus. Vestibulum
                                    libero eros, aliquet at tempus ut,
                                    scelerisque sit amet nunc. Vivamus id porta
                                    neque, in pulvinar ipsum. Vestibulum sit
                                    amet quam sem. Pellentesque accumsan
                                    consequat venenatis. Pellentesque sit amet
                                    justo dictum, interdum odio non, dictum
                                    nisi. Fusce sit amet turpis eget nibh
                                    elementum sagittis. Nunc consequat lacinia
                                    purus, in consequat neque consequat id.
                                </div>
                            </div>
                        </div>
                        <!-- end:Panel -->
                        <h4 class="m-t-20">Contact Customer Support</h4>
                        <p> If you"re looking for more help or have a question
                            to ask, please </p>
                        <p> <a href="contact.html"
                                class="btn theme-btn m-t-15">contact us</a> </p>
                    </div>
                    <!-- /WHY? -->
                </div>
            </div>
        </section>
        <?php
    include ("footer.php");
?>
</body>

</html>