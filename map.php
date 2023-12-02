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
                    <form>
                        <h1>Thông tin chuyến</h1>
                        <div class="left-form">
                            <i style="color:red;" class="fa-solid fa-location-dot"></i>
                            <input id="autocomplete" placeholder="Nhập địa chỉ đi..." type="text" required></input>
                        </div>
                        <div class="left-form">
                            <i style="color:blue;" class="fa-solid fa-location-dot"></i>
                            <input id="autocomplete-den" placeholder="Nhập địa chỉ đến..." type="text" required></input>
                        </div>
                        <div class="map-btn">
                            <button onclick="showSumbit()" type="button">Xem chuyến đi</button>
                        </div>
                    </form>
                </div>
                <div class="main-map-right">
                    <!-- bản đồ -->
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
            </div>
        </div>
    </section>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDksMnFQUmqOnGZGBIzVacv6YPEgYl8O30&libraries=places&callback=initAutocomplete"
        async defer></script>


    <script>
    var options = {
        types: ["geocode"],
        componentRestrictions: {
            country: "VN"
        }
    };

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById("autocomplete")), options
        );
        autocomplete.addListener("place_changed", fillInAddress);



        autocompleteDen = new google.maps.places.Autocomplete(
            (document.getElementById("autocomplete-den")), options
        );
        autocompleteDen.addListener("place_changed", fillInAddressDen);

    }

    var addressDi = '';
    var addressDen = '';

    function fillInAddress() {

        var place = autocomplete.getPlace();
        addressDi = place.formatted_address
        // if (addressDi != '' && addressDen != '') {
        //     showMap(addressDi, addressDen);
        // }

    }

    function fillInAddressDen() {
        var place = autocompleteDen.getPlace();
        addressDen = place.formatted_address
        // if (addressDi != '' && addressDen != '') {
        //     showMap(addressDi, addressDen);
        // }

    }


    function showMap(start, end) {
        var mapProp = {
            center: new google.maps.LatLng(16.0544, 108.2022),
            zoom: 12,
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            // Kiểm tra xem yêu cầu chỉ đường đã thành công hay không.
            if (status == google.maps.DirectionsStatus.OK) {
                // Nếu yêu cầu thành công, đoạn mã này sẽ sử dụng directionsRenderer để hiển thị đường đi trên bản đồ.
                directionsRenderer.setDirections(response);

                // Hiển thị thông tin thời gian di và khoảng cách
                // Lấy thông tin về tuyến đường từ phản hồi. Trong trường hợp này, chỉ lấy tuyến đường đầu tiên
                var route = response.routes[0];
                // Khởi tạo biến để tính tổng thời gian và khoảng cách của tuyến đường.
                var duration = 0;
                var distance = 0;
                // Lặp qua các phần của tuyến đường (legs) để tính tổng thời gian và khoảng cách.
                for (var i = 0; i < route.legs.length; i++) {
                    duration += route.legs[i].duration.value;
                    distance += route.legs[i].distance.value;
                }
                // Chuyển đổi thời gian từ giây sang phút và làm tròn.
                var durationInMinutes = Math.round(duration / 60);
                // Chuyển đổi khoảng cách từ mét sang kilômét và làm tròn đến hai chữ số thập phân.
                var distanceInKm = (distance / 1000).toFixed(2);

                // Lấy vị trí giữa đoạn đường và sử dụng nó để đặt vị trí InfoWindow
                var routeCenter = route.overview_path[Math.floor(route.overview_path.length / 2)];
                // Tạo một InfoWindow với nội dung là thời gian và khoảng cách, sau đó đặt vị trí của InfoWindow tại routeCenter và mở nó trên bản đồ.
                var infoWindow = new google.maps.InfoWindow({
                    content: durationInMinutes + " phút<br>" + distanceInKm + " km"
                });

                infoWindow.setPosition(routeCenter);
                infoWindow.open(map);
            }
        });
    }

    function showSumbit() {
        if (addressDi != '' && addressDen != '') {
            showMap(addressDi, addressDen);
        }
    }
    </script>



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