function finishVisit(){
    $.ajax({
        type: "GET",
        url: "../requests/finish-visit.php",

        success: function(responce){
            console.log(responce);
            $.ajax({
                type: "GET",
                url: "../requests/exit-to-main-page.php",
        
                success: function(responce){
                    alert("Сплачено!");
                    setTimeout(function(){
                        window.location.href = '../php/main-page.php';
                    },500);
                }
            });
        }
    });
}