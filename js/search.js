$(document).ready(function() {
    $("#search-input").on("input", function() {
        var key = $(this).val();
        $.ajax({
            type: "GET",
            url: "search_confirm.php",
            data: { key: key },
            success: function(data) {
                var results = data.split(', '); 
                var $countSearch = $("#countSearchh");
                $countSearch.empty(); 

                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var span = document.createElement("span");
                        span.textContent = results[i];                                             
                        span.style.display = "block";                                           
                        $countSearch.append(span);
                    }
                } else {
                    var listItem = document.createElement("li");
                    listItem.textContent = "Không tìm thấy kết quả phù hợp.";
                    $countSearch.append(listItem);
                }
            }
        });
    });
});