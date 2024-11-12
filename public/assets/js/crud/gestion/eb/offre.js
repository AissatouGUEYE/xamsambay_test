$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')

    $(".active-offre").click(function(e) {
        e.preventDefault();
        // alert();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous choisir cette offre ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/eb_offre/accepter/" + id,
                    method: "PUT",
                    headers: {
                        Authorization: "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: "JSON",
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Offre acceptée avec succès",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'acceptation de l'Offre",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Choix annulé !",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
    // $(".deactive-user").click(function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr("id");
    //     swal({
    //         title: "Etes-vous sure",
    //         text: "Voulez-vous désactiver l'utilisateur",
    //         icon: "warning",
    //         dangerMode: true,
    //         buttons: {
    //             cancel: "Annuler",
    //             delete: "Oui",
    //         },
    //     }).then(function(willDelete) {
    //         if (willDelete) {
    //             $.ajax({
    //                 url: base_url + "/eb_offre/rejeter/" + id,
    //                 method: "PUT",
    //                 headers: {
    //                     Authorization: "Bearer " +
    //                         jQuery('meta[name="token"]').attr("content"),
    //                 },
    //                 // data:$('#formAddUser').serialize(),
    //                 dataType: "JSON",
    //                 success: (res) => {
    //                     swal({
    //                         title: "Success",
    //                         icon: "success",
    //                         text: "Utilisateur désactivé avec succés",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     location.reload();
    //                 },
    //                 error: () => {
    //                     swal({
    //                         title: "Cancelled",
    //                         icon: "error",
    //                         text: "Erreur lors de la désactivation de l'utilisateur",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     // location.reload()
    //                 },
    //             });
    //         } else {
    //             swal({
    //                 title: "Cancelled",
    //                 icon: "error",
    //                 text: "Erreur lors de la désactivation de  l'utilisateur",
    //                 timer: 2000,
    //                 buttons: false,
    //             });
    //         }
    //     });
    // });


});