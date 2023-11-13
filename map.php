<?php
    include ("html.php");
?>

<body>

    <?php
    include ("header.php");
?>

    <section class="popular">
        <div class="container">
            <div class="main-map">

                <div class="main-map-left">
                    <form action="" method="get">
                        <h1>Thông tin chuyến</h1>
                        <div class="left-form">
                            <i style="color:red;" class="fa-solid fa-location-dot"></i>
                            <input type="text" placeholder="Nhập địa chỉ đi...">
                        </div>
                        <div class="left-form">
                            <i style="color:blue;" class="fa-solid fa-location-dot"></i>
                            <input type="text" placeholder="Nhập địa chỉ đến...">
                        </div>
                        <div class="map-btn">
                            <button type="submit">Xem chuyến đi</button>
                        </div>
                    </form>
                </div>
                <div class="main-map-right">
                    <!-- bản đồ -->
                    <!-- <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.3706038693595!2d108.23499237459959!3d16.04624704005383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219d8a6e1e1cd%3A0x9cabe05fda29303!2zMTEyIEhvw6BpIFRoYW5oLCBC4bqvYyBN4bu5IFBow7osIE5nxakgSMOgbmggU8ahbiwgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1699715025955!5m2!1svi!2s"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                    <div class="googleMap"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(51.508742, -0.120850),
            zoom: 5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQkGipUGlRVnEMMK6FjRgZV6RSsqtrdHA&callback=myMap"></script>
    <style>
    .main-map {
        display: flex;
        margin-top: 50px
    }

    .main-map .main-map-left {
        width: 30%;
        margin-right: 15px;
    }

    .main-map .main-map-left form {
        padding: 10px;
        border: 1px solid blue;
    }

    .main-map .main-map-left form .left-form {
        padding: 15px;
        position: relative;
    }

    .main-map .main-map-left form .left-form i {
        position: absolute;
        bottom: 28px;
        left: 21px;
    }

    .main-map .main-map-left form .left-form input {
        width: 100%;
        height: 40px;
        padding-left: 25px;
    }

    .main-map .main-map-left form h1 {
        text-align: center;
        font-size: 30px;
        color: blue;
    }

    .main-map .main-map-right {
        width: 70%;
    }

    .main-map .map-btn {
        padding: 0 15px;
        margin-bottom: 30px;
    }

    .main-map .map-btn button {
        width: 100%;
        height: 40px;
        color: white;
        background: blue;
        border: none;
        border-radius: 38px;
        cursor: pointer;
    }
    </style>

    <?php
    include ("footer.php");
?>
</body>



</html>