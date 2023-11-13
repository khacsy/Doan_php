<header id="header" class="header-scroll top-header headrom">
        
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button"
                    data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img
                        class="img-rounded" src="images/logotruong.png" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right"
                    id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active"
                                href="index.php">Trang Chủ <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active"
                                href="restaurants.php">Nhà Hàng <span
                                    class="sr-only"></span></a> </li>
                        <li class="nav-item"> <a class="nav-link active"
                                href="map.php">Map<span
                                    class="sr-only"></span></a> </li>
                        


                        <?php
                    if(empty($_SESSION["user_id"])) // if user is not login
                        {
                            echo '
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Đăng Nhập</a>
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user" style="
                                    background-color: white !important;">
                                    <li> <a class="dropdown-item" href="./arst/index.php">Restaurant</a> </li>
                                    <li> <a class="dropdown-item" href="login.php"></i>User</a> </li>
                                    
                                    </ul>
                                </div>
                              </li>;
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Đăng Ký</a>
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user" style="
                                    background-color: white !important;">
                                    <li> <a class="dropdown-item" href="register.php"> Restaurant</a> </li>
                                    <li> <a class="dropdown-item" href="registration.php"></i> User</a> </li>
                                    
                                    </ul>
                                </div>
                              </li>;
                                ';
                        }
                    else
                        {
                                //if user is login
                                
                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
                                echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> '.$_SESSION["username"].'</a>
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user" style="
                                    background-color: white !important;">
                                    <li> <a class="dropdown-item" href="change_password.php"><i class="fa fa-gear"></i> Đổi mật khẩu</a> </li>
                                    <li> <a class="dropdown-item" href="Logout.php"><i class="fa fa-power-off"></i> Đăng Xuất </a> </li>
                                    
                                    </ul>
                                </div>
                              </li>';
                        }

                    ?>
                        <li class="nav-item">
                            <form action="search.php" method="get">
                                <input type="text" name="key" />
                                <button type="submit" >Tìm kiếm</button> <i class = "fas fa-bell thongbao" ></i>
                                
                            </form>
                            
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

        <!-- /.navbar -->
    </header>
    <script>
                        $(document).ready(function() {
                            $("#search-input").on("input", function() {
                                var key = $(this).val();
                                $.ajax({
                                    type: "GET",
                                    url: "search_confirm.php",
                                    data: {
                                        key: key
                                    },
                                    success: function(data) {
                                        var results = data.split(', ');
                                        var $countSearch = $("#countSearchh");
                                        $countSearch.empty();

                                        if (results.length > 0) {
                                            for (var i = 0; i < results.length; i += 2) {
                                                var title = results[i];
                                                var name = results[i + 1];

                                                var resultDiv = document.createElement(
                                                    "div");

                                                var titleSpan = document.createElement(
                                                    "span");
                                                titleSpan.textContent = title;
                                                titleSpan.style.display = "block";
                                                titleSpan.style.fontWeight = "bold";

                                                var nameSpan = document.createElement(
                                                    "span");
                                                nameSpan.textContent = name;
                                                nameSpan.style.display = "block";

                                                resultDiv.appendChild(titleSpan);
                                                resultDiv.appendChild(nameSpan);

                                                $countSearch.append(resultDiv);
                                            }
                                        } else {
                                            var span = document.createElement("span");
                                            span.textContent =
                                                "Không tìm thấy kết quả phù hợp.";
                                            span.style.display = "inline";
                                            span.style.color = "red";
                                            $countSearch.append(span);
                                        }
                                    }
                                });
                            });
                        });
                        </script>