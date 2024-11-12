$(document).ready(function () {

    $("#btn-push-collecte").click(function (e) {


        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous diffuser les informations de collecte",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                // code


                var url = new URL(window.location.href);
                var  date = $("#datep").text()
                var qte  = parseInt($("#qte").text())
                var  phenom = $("#phenom").text()
                var  tjp = parseInt($("#tjp").text())
                var cumul  = parseInt($("#cumul").text())
                var collecte = parseInt(url.pathname.split("/")[4])
                var pluvio = parseInt(url.pathname.split("/")[5]);
                var message = "Pluie du "+date+":\nQuantité:"+qte+"\nPhénoméne Observé: "+phenom+"\nJours de Pluie: "+tjp+"\nCumul: "+cumul


                var msg_form = new FormData()
                msg_form.append("pluvio", pluvio)
                msg_form.append("collecte", collecte)
                msg_form.append("message", message)

                $.ajax({
                    type: "POST",
                    url: "/information-climatique/collecte/make-push",
                    headers:{
                        "X-CSRF-TOKEN": jQuery(
                            'meta[name="csrf-token"]'
                        ).attr("content"),
                    },
                    data:msg_form,
                    dataType: "json",
                    contentType: false,
                    // cache: false,
                    processData: false,
                    success: function (response) {
                        var swal_title = "Success"
                        var swal_icon = "success"
                        if (response.status == 200) {
                            swal_title = "Success"
                            swal_icon = "success"

                        }else{
                            swal_title = "Erreur"
                            swal_icon = "error"
                        }
                        swal({
                            title: swal_title,
                            icon: swal_icon,
                            text: response.message,
                            timer: 5000,
                            buttons: false,
                        });
                        window.location.replace('/information-climatique/collecte')
                    },
                    error: () => {
                        alert()
                    }
                    });
            }else {

            }

    });

})
});

