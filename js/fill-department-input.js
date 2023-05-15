$.ajax({
    type: "GET",
    url: "../requests/get-current-department.php",
    success: function (response) {
        if(response != null){
            $(".department-input").first().val(response);
            $(".department-input").first().prop('disabled', true);
        }
    }
});