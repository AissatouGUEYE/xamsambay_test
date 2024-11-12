$(document).ready(function () {
    // alert("Neima Yeah")

    $("#form-producteur-list-prix").submit(function (e) {
        e.preventDefault();
        alert("Neima Yeah")

    });
});
// let nombre = $("#nb").text();
//                         // alert(nombre);
//                             $.ajax({
//                             type: "get",
//                             url: "/utilisateurs/nb",
//                             // data: "data",
//                             dataType: "json",
//                             success:  function (response) {
//                                 var init_val = response
//                                 var mkreq =   setInterval(() => {
//                                     $.ajax({
//                                     type: "get",
//                                     url: "/utilisateurs/nb",
//                                 // data: "data",
//                                     dataType: "json",
//                                     success: function (response) {
//                                     var new_val = response;
//                                     var diff  = new_val - init_val
//                                     var percentage = Math.round((diff * 100) / nombre)

//                                     if (percentage < 100) {
//                                         // $("#percent").empty()
//                                         $("#percent").text(percentage+"%");
//                                         $(".determinate").width(percentage+"%");
//                                     }
//                                     else if (percentage == 100){
//                                         percentage = 100
//                                         $("#percent").text("Completed");
//                                         $(".determinate").width(percentage+"%");
//                                         clearInterval(mkreq)
//                                     }
//                                 },
//                                 error: () => {
//                                     alert("Error")
//                                 }
//                         });

//                                 }, 5000);

//                             },
//                             error: () => {
//                                 alert("Error")
//                             }
//                         });
