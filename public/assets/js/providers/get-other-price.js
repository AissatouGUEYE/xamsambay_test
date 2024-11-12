$(document).ready(function () {
    var my_url = jQuery('meta[name="url"]').attr("content");
    var produit = $("#produit").attr("data-id");
    var region = $("#market-region").val();
    var list = $("#price-recap");
    // var days = daysdifference('/31/2022', new Date());
    var get_price_data = (produit,region) => {
        let message_input = $("#message-input");
        message_input.empty()
        message_input.attr("value",null);

        // var el = document.createElement('span');
        //                 // el.style.cssText = 'color:#F6BB42';
        //                 el.append(<div class='preloader-wrapper big active'>
        //                 <div class='spinner-layer spinner-blue-only'>
        //                 <div class='circle-clipper left'><div class='circle'></div>
        //                 </div><div class='gap-patch'>
        //                 <div class='circle'></div>
        //                 </div><div class='circle-clipper right'>
        //                 <div class='circle'></div></div></div></div>);
        //                 swal({
        //                 title: 'HTML Alert!',
        //                 content: {
        //                     element:el

        //                 }
        // });
    // alert(produit)
        $.ajax({
            type: "GET",
            url: my_url + "/prix/search/"+produit+"/"+region,
            headers: {
                'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
            },
            dataType: "json",
            success: function(resultat) {
                if (resultat.length != 0) {

                    var message = "Prix "+resultat[0].produit+" sur "+resultat[0].region+": \n"
                    list.empty();
                    list.append("<li class='display-flex justify-content-between'>"+
                    "<span class='invoice-subtotal-title'>Région</span>"+
                    "<h6 class='invoice-subtotal-value'>"+resultat[0].region+"</h6></li>");
                    list.append(" <li class='display-flex justify-content-between'>"+
                    "<span class='invoice-subtotal-title'>Produit</span>"+
                    "<h6 class='invoice-subtotal-value'>"+resultat[0].produit+"</h6></li>");
                    list.append("<div class='divider mt-2 mb-2'></div>")


                $.each(resultat, function(i, val) {
                    if (val.type_market === "hebdomadaire" && daysdifference(val.date_creation, new Date()) <= 8) {
                        list.append("<li class='display-flex justify-content-between'>"+
                        "<span class='invoice-subtotal-title'>"+val.marche+"</span>"+
                        "<h6 class='invoice-subtotal-value'>"+val.prix_en_gros+"/"+val.unite+"</h6></li>");
                        message = message+""+val.marche+": "+val.prix_en_gros+"/"+val.unite+"; \n"

                    }else if(val.type_market === "journalier" && daysdifference(val.date_creation, new Date()) <= 3 ){
                        list.append("<li class='display-flex justify-content-between'>"+
                        "<span class='invoice-subtotal-title'>"+val.marche+"</span>"+
                        "<h6 class='invoice-subtotal-value'>"+val.prix_en_gros+"/"+val.unite+"</h6></li>")
                        message = message+""+val.marche+": "+val.prix_en_gros+"/"+val.unite+"; \n"
                    }
                    // console.log(val.nom_typentite)
                });

                message_input.attr("value",message);


                }else{
                    list.empty();

                    list.append("<li class='display-flex justify-content-between'>"+
                    "<span class='invoice-subtotal-title'>Informations non disponibles</span>"+
                    "<h6 class='invoice-subtotal-value'></h6></li>")

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur d.");
            }

        });

        $.ajax({
            type: "GET",
            url: my_url+"/nombre/null/null/null/"+region+"/null/null/null/null/null/"+produit,
            headers: {
                'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
            },
            dataType: "json",
            success:  function (resultat) {
                console.log(resultat[0].nombre)
                // e.preventDefault();
                list.append("<div class='divider mt-2 mb-2'></div>")
                list.append("<li class='display-flex justify-content-between'>"+
                "<span class='invoice-subtotal-title'>Nombre de producteurs</span>"+
                "<h6 class='invoice-subtotal-value'>"+resultat[0].nombre_user_prix+"</h6></li>");

            },
            error: () =>{

            }
        });
}

get_price_data(produit,region)

$("#market-region").change(function (e) {

    e.preventDefault();
    get_price_data(produit,$(this).val())





});




    $("#sms-push-btn").click(function (e) {
        e.preventDefault();

        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous diffuser les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#diffusion").attr({disabled: true});
                $("#preloader").attr({class: "preloader-wrapper small active"});
                $.ajax({
                    url: "/prix-du-marche/prix/sms",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
                    },
                    data: $("#price-sms-form").serialize(),
                    // dataType:'JSON',
                    // ajaxStart:()=>{
                    //     // var el = document.createElement('span');

                    // },
                    success: (res) => {
                        // alert(res.data)
                        if (res.status == 200) {

                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message+"\n"+res.nl+"\n"+res.li,
                            timer: 5000,
                            buttons: false,
                        });
                    }else if( res.status == 500){
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                    }

                        location.reload()

                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload()
                    },
                });
            } else {
                location.reload();
            }
        });
    });
// Add two dates to two variables
// alert(days);

function daysdifference(firstDate, secondDate){
    var startDay = new Date(firstDate);
    var endDay = new Date(secondDate);

// Determine the time difference between two dates
    var millisBetween = startDay.getTime() - endDay.getTime();

// Determine the number of days between two dates
    var days = millisBetween / (1000 * 3600 * 24);

// Show the final number of days between dates
    return Math.round(Math.abs(days));
}
});
