<?php
    include ("html.php");
    include_once 'product-action.php';
?>

<body>
    <!--header starts-->
    <?php
    include ("header.php");
?>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Chọn Nhà Hàng</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Đặt
                            món ăn yêu thích của bạn</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Giao hàng và thanh toán</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);                                  
                                            $_SESSION['id_rs'] = $_GET['res_id'];                                      
										  ?>
        <section class="inner-page-hero bg-image" data-image-src="images/img/dish.jpeg" style="background-image: url('images/img/dish.jpeg');">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure>
                                    <?php echo '<img src="arst/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?>
                                </figure>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a>
                                </h6>
                                <p><?php echo $rows['address']; ?></p>
                                <ul class="nav nav-inline">
                                    <li class="nav-item"> <a class="nav-link active" href="#"><i
                                                class="fa fa-check"></i> Min $
                                            10,00</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i>
                                            30 min</a> </li>
                                    <li class="nav-item ratings">
                                        <a class="nav-link" href="#"> <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- end:Inner page hero -->
        <div class="breadcrumb">
            <div class="container">

            </div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Đơn Hàng Của Bạn
                            </h3>


                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">


                                <?php

$item_total = 0;

                        foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                        {
                        ?>

                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a
                                        href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0"
                                            value=<?php echo $item["price"] . "đ"; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly
                                            value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>

                                </div>

                                <?php
                        $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
                        }
                        ?>



                            </div>
                        </div>

                        <!-- end:Order row -->

                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>Tổng Tiền</p>
                                <h3 class="value">
                                    <strong><?php echo $item_total.".000đ"; ?></strong>
                                </h3>
                                <p>Ưu đãi Free Ship</p>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"
                                    class="btn theme-btn btn-lg button">Đặt
                                    Hàng</a>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">

                    <!-- end:Widget menu -->
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Các món ăn xịn xò!! ~~~<a class="btn btn-link pull-right" data-toggle="collapse"
                                    href="#popular2" aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php  // display values and item of food/dishes
									$stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{
						
													
													 
													 ?>
                            <div class="food-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <form method="post"
                                            action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left"
                                                    href="#"><?php echo '<img src="arst/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a>
                                                </h6>
                                                <p> <?php echo $product['slogan']; ?>
                                                </p>
                                            </div>
                                            <!-- end:Description -->
                                    </div>
                                    <!-- end:col -->
                                    <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                        <span class="price pull-left"><?php echo $product['price']; ?>
                                            đ</span>
                                        <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" min="0"
                                            value="1" size="2" />
                                        <input type="submit" class="btn theme-btn" style="width:10rem;"
                                            value="Thêm vào giỏ hàng" />
                                    </div>
                                    </form>
                                </div>
                                <!-- end:row -->
                            </div>
                            <!-- end:Food item -->

                            <?php
									  }
									}
									
								?>



                        </div>
                        <!-- end:Collapse -->
                    </div>
                    <!-- end:Widget menu -->

                </div>
                <!-- end:Bar -->
                <div class="col-xs-12 col-md-12 col-lg-3">
                    <div class="sidebar-wrap">
                        <div class="widget clearfix">
                            <!-- /widget heading -->
                            
                        </div>
                    </div>
                </div>
                <!-- end:Right Sidebar -->
            </div>
            <!-- end:row -->
        </div>

        <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body cart-addon">
                        <div class="food-item white">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="item-img pull-left">
                                        <a class="restaurant-logo pull-left" href="#"><img
                                                src="http://placehold.it/70x70" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="rest-descr">
                                        <h6><a href="#">Sandwich de Alegranza Grande
                                                Menü (28 - 30 cm.)</a></h6>
                                    </div>
                                    <!-- end:Description -->
                                </div>
                                <!-- end:col -->
                                <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                    <span class="price pull-left">$
                                        2.99</span>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-lg-4">
                                    <div class="row no-gutter">
                                        <div class="col-xs-7">
                                            <select class="form-control b-r-0" id="exampleSelect2">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" type="number" value="0" id="quant-input-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:row -->
                        </div>
                        <!-- end:Food item -->
                        <div class="food-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="item-img pull-left">
                                        <a class="restaurant-logo pull-left" href="#"><img
                                                src="http://placehold.it/70x70" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="rest-descr">
                                        <h6><a href="#">Sandwich de Alegranza Grande
                                                Menü (28 - 30 cm.)</a></h6>
                                    </div>
                                    <!-- end:Description -->
                                </div>
                                <!-- end:col -->
                                <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                    <span class="price pull-left">$
                                        2.49</span>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-lg-4">
                                    <div class="row no-gutter">
                                        <div class="col-xs-7">
                                            <select class="form-control b-r-0" id="exampleSelect3">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" type="number" value="0" id="quant-input-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:row -->
                        </div>
                        <!-- end:Food item -->
                        <div class="food-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="item-img pull-left">
                                        <a class="restaurant-logo pull-left" href="#"><img
                                                src="http://placehold.it/70x70" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="rest-descr">
                                        <h6><a href="#">Sandwich de Alegranza Grande
                                                Menü (28 - 30 cm.)</a></h6>
                                    </div>
                                    <!-- end:Description -->
                                </div>
                                <!-- end:col -->
                                <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                    <span class="price pull-left">$
                                        1.99</span>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-lg-4">
                                    <div class="row no-gutter">
                                        <div class="col-xs-7">
                                            <select class="form-control b-r-0" id="exampleSelect5">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" type="number" value="0" id="quant-input-4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:row -->
                        </div>
                        <!-- end:Food item -->
                        <div class="food-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="item-img pull-left">
                                        <a class="restaurant-logo pull-left" href="#"><img
                                                src="http://placehold.it/70x70" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="rest-descr">
                                        <h6><a href="#">Sandwich de Alegranza Grande
                                                Menü (28 - 30 cm.)</a></h6>
                                    </div>
                                    <!-- end:Description -->
                                </div>
                                <!-- end:col -->
                                <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                    <span class="price pull-left">$
                                        3.15</span>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-lg-4">
                                    <div class="row no-gutter">
                                        <div class="col-xs-7">
                                            <select class="form-contheme-bttrol b-r-0" id="exampleSelect6">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" type="number" value="0" id="quant-input-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:row -->
                        </div>
                        <!-- end:Food item -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn theme-btn">Add to
                            cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:Container -->
        <?php
    include ("footer.php");
?>
</body>

</html>